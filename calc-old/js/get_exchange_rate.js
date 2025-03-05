function initializeGetRate() {
    $.ajax({
        type: "POST",
        url: calcTypeUrl === '/calc-layout/ext_html/cargo_order_data.php'
            ? "https://api-calc.wisetao.com:4343/api/get-exchange-rates"
            : "https://api-calc.wisetao.com:4343/api/get-exchange-rates/1",
        success: function (response) {
            $('.exchange-rate-container .exchange-rate-elem-dollar').html(response.dollar);
            dollarGlobal = response.dollar;
            $('.exchange-rate-container .exchange-rate-elem-yuan').html(response.yuan);
            yuanGlobal = response.yuan;
            if (calcTypeUrl === '/calc-layout/ext_html/cargo_order_data.php') {
                $('.yuan-link').removeClass('hidden');
                $('.rate-info').addClass('hidden');
            }
            else {
                $('.yuan-link').addClass('hidden');
                $('.rate-info').removeClass('hidden');
            }

        },
        error: function (error) {

        },
    });
}