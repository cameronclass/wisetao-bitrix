let myMap, searchControl, result, getAddressButton, resAddress = '';
let services = document.getElementById('services');
let services_header = document.getElementById('services_header');
let main_map= document.getElementById('map');
let order = document.getElementById('order');
let categories_header = document.getElementById('categories_header');
let categories = document.getElementById('categories');
let subcategories = document.getElementById('subcategories');
let subcategories_header = document.getElementById('subcategories_header');
let equipment_header = document.getElementById('equipment_header');
let equipments = document.getElementById('equipments');
let sel_service = document.getElementById('sel_service');
let sel_subcategory = document.getElementById('sel_subcategory');
let sel_equipment = document.getElementById('sel_equipment');
let show_services = document.getElementById('show_services');
let address = document.getElementById('address');
let sub_data = document.getElementById('sub_data');
let add_subcategory_header = document.getElementById('add_subcategory_header');
ymaps.ready(init);

function init() {
    myMap = new ymaps.Map('map', {
        center: [55.45, 37.36],
        zoom: 7,
        controls: []

    });
    searchControl = new ymaps.control.SearchControl({
        options: {
            // Будет производиться поиск по топонимам и организациям.
            provider: 'yandex#search'
        }
    });
    searchControl.events.add('resultselect', function (e) {
        result = searchControl.getResult(0);
        result.then(function (res) {
            resAddress = res._geoObjectComponent._properties._data.address;
        }, function (err) {
            console.log("Ошибка");
        });
    })
    getAddressButton = new ymaps.control.Button({
        data: {
            // Зададим текст и иконку для кнопки.
            content: "Добавить адрес к заказу",
            // Иконка имеет размер 16х16 пикселей.
        },
        options: {
            // Поскольку кнопка будет менять вид в зависимости от размера карты,
            // зададим ей три разных значения maxWidth в массиве.
            maxWidth: 200
    }});
    getAddressButton.events
        .add(
            'press',
            function () {
                let page = document.baseURI.split('/').at(-1);
                if (page !== "add-subcategory") {
                    services.hidden = true;
                    main_map.hidden = true;
                    services_header.hidden = true;
                    order.hidden = false;
                    categories.hidden = true;
                    categories_header.hidden = true;
                    subcategories.hidden = true;
                    subcategories_header.hidden = true;
                    equipments.hidden = true;
                    equipment_header.hidden = true;
                    if (header_main !== null) {
                        header_main.hidden = false;
                    }
                    if (sel_service.children[0].innerText !== 'selected service') {
                        sel_service.hidden = false;
                    }
                    if (!sel_subcategory.children[0].innerText.includes('selected')) {
                        sel_subcategory.hidden = false;
                        sel_equipment.hidden = false;
                    }
                    if (show_services !== null && sel_subcategory.children[0].innerText.includes('selected')) {
                        show_services.hidden = false;
                    }
                    if (resAddress !== '') {
                        address.value = resAddress;
                    }
                }
                else {
                    sub_data.hidden = false;
                    add_subcategory_header.hidden = false;
                    main_map.hidden = true;
                    if (resAddress !== '') {
                        address.value = resAddress;
                    }
                }
            }
        )
    myMap.controls.add(searchControl);
    myMap.controls.add(getAddressButton, {
        float: "left"
    });
}
