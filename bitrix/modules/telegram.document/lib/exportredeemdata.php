<?php

namespace Telegram\Document;

use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Context;
use Bitrix\Main\HttpRequest;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CTempFile;

class ExportRedeemData
{
    protected $data;
    protected $dimensions = [];
    protected $rates = [];

    public function __construct()
    {
        $this->rates = $this->getExchangeRates();
        $this->data = Context::getCurrent()->getRequest();
    }

    protected function getExchangeRates()
    {
        $options = [
            "disableSslVerification" => true,
        ];
        $http = new HttpClient($options);
        $http->setHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]);
        return json_decode($http->post('https://api-calc.wisetao.com:4343/api/get-exchange-rates'), true);
    }

    protected function getPricesYuan($data)
    {
        $pricesYuan = 0;
        foreach ($data as $key => $item) {
            foreach ($item as $key_ => $item_) {
                if ($item_['currency'] == '$') {
                    $pricesYuan += round($item_['cost'] * $item_['quantity'] * $this->rates['dollar'] / $this->rates['yuan'], 2);
                }
                if ($item_['currency'] == '¥') {
                    $pricesYuan += round($item_['cost'] * $item_['quantity'], 2);
                }
                if ($item_['currency'] == '₽') {
                    $pricesYuan += round($item_['cost'] * $item_['quantity'] / $this->rates['yuan'], 2);
                }
            }
        }
        return $pricesYuan;
    }

    public function generateSpreadsheet()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $yuanRate = $this->rates['yuan'];
        $sumPrice = $this->getPricesYuan($this->data);
        $chinaDeliveryTitle = 'Доставка по Китаю, ¥';
        $totalCostDeliveryTitle = 'Общяя стоимость заказа с учетом доставки по Китаю, ¥';
        $commissionTitle = 'Комиссия 5%, ¥';
        $totalTitle = 'Итого, ¥';
        $totalRubTitle = 'Сумма в рублях, коэффициент юаня перевода '.$yuanRate.'₽';
        $sumQuantity = 0;

        // Добавление заголовков
        $sheet->fromArray([
            ['Фото товара', 'Наименование товара', 'Размер', 'Цвет', 'Ссылка интернет магазина на товар', 'Цена за единицу', 'Общая стоимость', 'Кол-во товаров', 'Примечание'],
        ], NULL, 'A1');

        // Добавление данных
        $rowIndex = 2;
        foreach ($this->data['data'] as $item) {
            $sheet->fromArray([
                ' ',
                $item['name'],
                $item['size'],
                $item['color'],
                $item['link'],
                $item['cost'].$item['currency'],
                ($item['cost'] * $item['quantity']).$item['currency'],
                $item['quantity'],
                $item['note'],
            ], NULL, 'A' . $rowIndex);
            $sumQuantity += $item['quantity'];
            $rowIndex++;
        }
        $l = count($this->data['data']) + 2;
        $ln = $l + 1;
        // Добавление дополнительных данных
        $sheet->fromArray([
            [$chinaDeliveryTitle, ' ', ' ', ' ', ' ', ' ', 0, $sumQuantity, ' '],
            [$totalCostDeliveryTitle, ' ', ' ', ' ', ' ', ' ', '=(G'.$l.'+'.$sumPrice.')& "¥"', ' ', ' '],
            [$commissionTitle, ' ', ' ', ' ', ' ', ' ', '=((LEFT(G'.$ln.', LEN(G'.$ln.')-1))*0.05)& "¥"', ' ', ' '],
            [$totalTitle, ' ', ' ', ' ', ' ', ' ', '=((LEFT(G'.$ln.', LEN(G'.$ln.')-1))+(LEFT(G'.$ln.', LEN(G'.$ln.')-1))*0.05)& "¥"', ' ', ' '],
            [$totalRubTitle, ' ', ' ', ' ', ' ', ' ', '=(((LEFT(G'.$ln.', LEN(G'.$ln.')-1))+(LEFT(G'.$ln.', LEN(G'.$ln.')-1))*0.05)*'.$yuanRate.')& "₽"', ' ', ' '],
        ], NULL, 'A' . $rowIndex);

        // Настройка стилей
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);
        $sheet->getStyle('A4:I4')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ]);
        $sheet->getStyle('A6:I7')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ]);
        $sheet->getStyle('A4:A7')->applyFromArray([
            'font' => [
                'italic' => true,
            ],
        ]);

        foreach ($this->data['data'] as $index => $item) {
            // Преобразование base64 в изображение и сохранение временного файла
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $item['photo']));
            $tempImagePath = tempnam($_SERVER['DOCUMENT_ROOT'] . '/upload/tmp/', uniqid());

            file_put_contents($tempImagePath, $imageData);

            // Получение размеров изображения
            [$width, $height] = getimagesize($tempImagePath);
            // Рассчитываем новые размеры с сохранением пропорций
            if ($width > $height) {
                $newWidth = 110;
                $newHeight = intval(110 * $height / $width);
            } else {
                $newWidth = intval(110 * $width / $height);
                $newHeight = 110;
            }

            // Создаем объект Drawing и добавляем его в таблицу
            $drawing = new Drawing();
            $drawing->setName('Image');
            $drawing->setDescription('Image Description');
            $drawing->setPath($tempImagePath);
            $drawing->setWidth($newWidth);
            $drawing->setHeight($newHeight);
            $this->dimensions[$index] = [
                'width' => $newWidth,
                'height' => $newHeight,
            ];
            $drawing->setWorksheet($sheet);
            $drawing->setCoordinates('A' . ($index + 2));
        }

        // Установка высоты строк
        foreach ($this->data['data'] as $index => $item) {
            $sheet->getRowDimension($index + 2)->setRowHeight($this->dimensions[$index]['height']);
            $sheet->getStyle($index + 2)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($index + 2)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        }
        // Настройка ширины столбцов по содержимому
        foreach (range('A', 'I') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Добавление изображений



        return $spreadsheet;
    }

    public function saveToFile($filename)
    {
        $spreadsheet = $this->generateSpreadsheet();
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save($filename);
    }
}