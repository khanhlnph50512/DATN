//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//:::                                                                         :::
//:::  This routine calculates the distance between two points (given the     :::
//:::  latitude/longitude of those points). It is being used to calculate     :::
//:::  the distance between two locations using GeoDataSource (TM) prodducts  :::
//:::                                                                         :::
//:::  Definitions:                                                           :::
//:::    South latitudes are negative, east longitudes are positive           :::
//:::                                                                         :::
//:::  Passed to function:                                                    :::
//:::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :::
//:::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :::
//:::    unit = the unit you desire for results                               :::
//:::           where: 'M' is statute miles (default)                         :::
//:::                  'K' is kilometers                                      :::
//:::                  'N' is nautical miles                                  :::
//:::                                                                         :::
//:::  Worldwide cities and other features databases with latitude longitude  :::
//:::  are available at https://www.geodatasource.com                         :::
//:::                                                                         :::
//:::  For enquiries, please contact sales@geodatasource.com                  :::
//:::                                                                         :::
//:::  Official Web site: https://www.geodatasource.com                       :::
//:::                                                                         :::
//:::               GeoDataSource.com (C) All Rights Reserved 2018            :::
//:::                                                                         :::
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

function distance(lat1, lon1, lat2, lon2, unit)
{
    if ((lat1 == lat2) && (lon1 == lon2))
    {
		return 0;
	}
    else
    {
		var radlat1 = Math.PI * lat1/180;
		var radlat2 = Math.PI * lat2/180;
		var theta = lon1-lon2;
		var radtheta = Math.PI * theta/180;
		var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        if (dist > 1)
        {
			dist = 1;
		}
		dist = Math.acos(dist);
		dist = dist * 180/Math.PI;
		dist = dist * 60 * 1.1515;
		if (unit=="K") { dist = dist * 1.609344 }
		if (unit=="N") { dist = dist * 0.8684 }
		return dist;
	}
}

function SortNearByUserLocation(data, posUser)
{
    var result = [];

    result = data.sort(function(a, b){
        var distance1 = distance(a.latitude, a.longitude, posUser.lat, posUser.lng);
        var distance2 = distance(b.latitude, b.longitude, posUser.lat, posUser.lng);
        if (distance1 < distance2)
        {
            return -1;
        }
        if (distance2 < distance1)
        {
            return 1;
        }
        return 0;
    });

    return result;
}

//----------------------------------------------------------------------------------------------------

function FormatText(str, arg)
{
    Object.keys(arg).map(function(key, index){
        str = str.replace(new RegExp('{' + key + '}', 'g'), arg[key]);
    });
    return str;
}

//----------------------------------------------------------------------------------------------------

// var dataLocation = [{"id":2486,"nameCity":"\u0110\u1eafk L\u1eafk","district":[{"id":2487,"nameDistrict":"Bu\u00f4n Ma Thu\u1ed9t"}]},{"id":2488,"nameCity":"H\u1ed3 Ch\u00ed Minh","district":[{"id":2489,"nameDistrict":"Qu\u1eadn 1"},{"id":2490,"nameDistrict":"Qu\u1eadn 10"},{"id":2491,"nameDistrict":"Qu\u1eadn 3"},{"id":2492,"nameDistrict":"Qu\u1eadn Ph\u00fa Nhu\u1eadn"},{"id":2493,"nameDistrict":"Qu\u1eadn T\u00e2n B\u00ecnh"}]}];
var dataLocation = [];
var isLoadingLocation = false;
(function AjaxLoadLocation(){
    var dataFilter = {};
    var linkLocation = $('#linkLocation').html();

    isLoadingLocation = true;
    $('.loading-filter').show();

    $.ajax({
        type: 'GET',
        url: linkLocation,
        global: false,
        data: dataFilter,
        success: function(response) {
            //Do Something
            dataLocation = response;
            isLoadingLocation = false;
        },
        error: function(xhr) {
            //Do Something to handle error
            isLoadingLocation = false;
        }
    });
})();

//----------------------------------------------------------------------------------------------------

// var dataShop = [{"shop_name":"ANANAS BU\u00d4N MA THU\u1ed8T","latitude":"12.6843821","longitude":"108.0428657","shop_address":"20 Nguy\u1ec5n \u0110\u1ee9c C\u1ea3nh, P. Th\u1eafng L\u1ee3i, TP. Bu\u00f4n Ma Thu\u1ed9t","shop_phone":"026.2651.1715","shop_opentime":"8:00 am - 9:00 pm","shop_image":"http:\/\/ananasvn.com\/staging\/wp-content\/themes\/ananas\/assets\/images\/Logo_Ananas.png","shop_district":2487,"shop_city":2486,"shop_type":2495,"shop_type_name":"Franchise"},{"shop_name":"ANANAS \u0110\u1eb6NG TH\u1eca NHU","latitude":"10.76908","longitude":"106.6950183","shop_address":"L\u1ea7u 1, 41 \u0110\u1eb7ng Th\u1ecb Nhu, P. Nguy\u1ec5n Th\u00e1i B\u00ecnh, Qu\u1eadn 1","shop_phone":"","shop_opentime":"9:00 am - 10:00 pm","shop_image":"http:\/\/ananasvn.com\/staging\/wp-content\/themes\/ananas\/assets\/images\/Logo_Ananas.png","shop_district":2489,"shop_city":2488,"shop_type":2499,"shop_type_name":"Standard"},{"shop_name":"ANANAS FLAGSHIP","latitude":"10.7701888","longitude":"106.690421","shop_address":"87 Nguy\u1ec5n Tr\u00e3i, P. B\u1ebfn Th\u00e0nh, Qu\u1eadn 1","shop_phone":"","shop_opentime":"9:00 am - 10:00 pm","shop_image":"http:\/\/ananasvn.com\/staging\/wp-content\/themes\/ananas\/assets\/images\/Logo_Ananas.png","shop_district":2489,"shop_city":2488,"shop_type":2494,"shop_type_name":"Flagship"},{"shop_name":"ANANAS HOA H\u1ed2NG","latitude":"10.7964477","longitude":"106.6881952","shop_address":"33 Hoa H\u1ed3ng, P.2, Qu\u1eadn Ph\u00fa Nhu\u1eadn","shop_phone":"028.6657.9912","shop_opentime":"9:00 am - 10:00 pm","shop_image":"http:\/\/ananasvn.com\/staging\/wp-content\/themes\/ananas\/assets\/images\/Logo_Ananas.png","shop_district":2492,"shop_city":2488,"shop_type":2499,"shop_type_name":"Standard"},{"shop_name":"ANANAS L\u00ca V\u0102N S\u1ef8","latitude":"10.788296","longitude":"106.6753553","shop_address":"386\/4 L\u00ea V\u0103n S\u1ef9, P.14, Qu\u1eadn 3","shop_phone":"028.6658.0727","shop_opentime":"9:00 am - 10:00 pm","shop_image":"http:\/\/ananasvn.com\/staging\/wp-content\/themes\/ananas\/assets\/images\/Logo_Ananas.png","shop_district":2491,"shop_city":2488,"shop_type":2499,"shop_type_name":"Standard"},{"shop_name":"ANANAS S\u01af V\u1ea0N H\u1ea0NH","latitude":"10.7741061","longitude":"106.6666827","shop_address":"796\/10 S\u01b0 V\u1ea1n H\u1ea1nh, P.12, Qu\u1eadn 10","shop_phone":"028.6270.4879","shop_opentime":"9:00 am - 10:00 pm","shop_image":"http:\/\/ananasvn.com\/staging\/wp-content\/themes\/ananas\/assets\/images\/Logo_Ananas.png","shop_district":2490,"shop_city":2488,"shop_type":2499,"shop_type_name":"Standard"},{"shop_name":"ANANAS V\u00d5 V\u0102N T\u1ea6N","latitude":"10.7705066","longitude":"106.6856276","shop_address":"L\u1ea7u 1, 418 V\u00f5 V\u0103n T\u1ea7n, P.5, Q.3","shop_phone":"028.6682.8975","shop_opentime":"9:00 am - 10:00 pm","shop_image":"http:\/\/ananasvn.com\/staging\/wp-content\/themes\/ananas\/assets\/images\/Logo_Ananas.png","shop_district":2491,"shop_city":2488,"shop_type":2498,"shop_type_name":"Special"}];
var dataShop = [];
var isLoadingListShop = false;
(function AjaxLoadShop(){
    var dataFilter = {};
    var linkShop = $('#linkShop').html();

    isLoadingListShop = true;
    $('.loading-filter').show();


    $.ajax({
        type: 'GET',
        dataType: 'json',
        global: false,
        url: linkShop,
        data: dataFilter,
        success: function(response) {
            //Do Something
            dataShop = response;
            isLoadingListShop = false;
        },
        error: function(xhr) {
            isLoadingListShop = false;
            //Do Something to handle error
        }
    });
})();

//----------------------------------------------------------------------------------------------------
function AddEventClick()
{
    if (window.innerWidth >=992)
    {
        $('#store-list .list-group-item.title').click(function(){
            $('#store-list').toggleClass('close');
        });

        $('#store-open-icon').click(function(){
            $('#store-list').toggleClass('close');
        });
    }
    $('#store-list .media').each(function(i){
        var spot_id = $(this).attr('spot_id');
        if (typeof spot_id !== "undefined")
        {
            $(this).click(function(){
                map.setCenter(arrMarker[+spot_id].getPosition());
                var content = FormatText(templateSpot, {
                    shop_name:      dataShop[i].shop_name,
                    shop_address:   dataShop[i].shop_address,
                    shop_phone:     dataShop[i].shop_phone,
                    shop_opentime:  dataShop[i].shop_opentime,
                    shop_image:     dataShop[i].shop_image
                });
                infoWindow.setContent(content);
                infoWindow.open(map, arrMarker[+spot_id]);

                $('#store-list .items .media .title').attr('class', 'title-1');
                $(this).find('.title-1').attr('class', 'title');
            });
        }
    });
}
//----------------------------------------------------------------------------------------------------

var paramSearch = {cityID : 0, districtID: 0, strTypeID : ''};
$('#city').change(function(){
    var idSelected = $(this).val();
    var listDistrict = dataLocation.filter(function(e){return e.id==+idSelected;});

    if (listDistrict.length > 0)
    {
        listDistrict = listDistrict[0].district;
    }

    //render District options
    $('#district').html('');
    var stringOption = '<option value="0">Quận / Huyện</option>';
    // for (var item of listDistrict)
    for (var i=0; i<listDistrict.length; i++)
    {
        stringOption += '<option value="'+ listDistrict[i].id +'">'+ listDistrict[i].nameDistrict +'</option>';
    }
    $('#district').append(stringOption);

    //update params to search
    paramSearch.cityID = +idSelected;
    paramSearch.districtID = 0;

    //update markers
    UpdateMarkers(paramSearch);

    //update List of shop
    UpdateHtmlListShop();
});

//----------------------------------------------------------------------------------------------------

$('#district').change(function(){
    var idSelected = $(this).val();

    //update params to search
    paramSearch.districtID = +idSelected;

    //update markers
    UpdateMarkers(paramSearch);

    //update List of shop
    UpdateHtmlListShop();
});

//----------------------------------------------------------------------------------------------------

$(".map-check-box input[type=checkbox]").on("click", function () {

    var strTemp = '';
    $(".map-check-box input:checkbox[type=checkbox]:checked").each(function(){
        strTemp += $(this).attr('data-id') + ' ';
    });

    //update params to search
    paramSearch.strTypeID = strTemp.trim();

    //update markers
    UpdateMarkers(paramSearch);

    //update List of shop
    UpdateHtmlListShop();
});

//----------------------------------------------------------------------------------------------------

function UpdateHtmlListShop()
{
    if (hasSpotVisible)
    {
        RenderHtmlListShop( isAllow ? SUCCESS : SUCCESS_NO_KM, pos);

        // set center
        var firstMarker = arrMarker.filter(function(e){ return e.getVisible();})[0];
        map.setCenter(firstMarker.getPosition());
    }
    else
    {
        RenderHtmlListShop(ERROR_SEARCH_NO_ITEM);
    }
}

//----------------------------------------------------------------------------------------------------

function UpdateMarkers(param)
{
    hasSpotVisible = false;
    if (arrMarker.length > 0)
    {
        for (var i=0; i<dataShop.length; i++)
        {
            if (param.cityID != 0 && param.cityID != dataShop[i].shop_city)
            {
                arrMarker[i].setVisible(false);
                continue;
            }
            if (param.districtID != 0 && param.districtID != dataShop[i].shop_district)
            {
                arrMarker[i].setVisible(false);
                continue;
            }
            if (param.strTypeID != '' && param.strTypeID.indexOf(dataShop[i].shop_type+'') === -1)
            {
                arrMarker[i].setVisible(false);
                continue;
            }
            arrMarker[i].setVisible(true);
            hasSpotVisible = true;
        }
    }
    infoWindow.close();
}

//----------------------------------------------------------------------------------------------------

var arrMarker = [];
function CreateMarkers(data)
{
    arrMarker = [];

    var marker, i;
    for (i = 0; i < data.length; i++) {
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(+data[i].latitude, +data[i].longitude),
          map: map,
          icon: image_spot
        });

        arrMarker.push(marker);

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            var content = FormatText(templateSpot, {
                shop_name:      data[i].shop_name,
                shop_address:   data[i].shop_address,
                shop_phone:     data[i].shop_phone,
                shop_opentime:  data[i].shop_opentime,
                shop_image:     data[i].shop_image
            });

            infoWindow.setContent(content);
            infoWindow.open(map, marker);
          }
        })(marker, i));
    }
}

//----------------------------------------------------------------------------------------------------
var templateSpot        =  $('#templateSpot').html();
var templateTitle       =  $('#templateTitle').html();
var templateShop        =  $('#templateShop').html();
var templateShopNoKM    =  $('#templateShopNoKM').html();
var templateNotice      =  $('#templateNotice').html();
//----------------------------------------------------------------------------------------------------
function CheckAllDataLoaded() {
    setTimeout(function () {
        if (isLoadingLocation || isLoadingListShop) {
            CheckAllDataLoaded();
        } else {
            RenderMap();
            $('.loading-filter').hide();
        }
    }, 200);
}

var map, infoWindow, pos, image_spot, content, isAllow, hasSpotVisible;
function initMap()
{
    CheckAllDataLoaded();
}

function RenderMap()
{
    isAllow = false;
    hasSpotVisible = false;
    pos = {lat: 10.7968957, lng: 106.6586167};
    map = new google.maps.Map(document.getElementById('map'), {
        center: pos,
        zoom: 14,
        mapTypeControl: false
    });

    image_spot = {
                // url: 'images/svg/dia_diem.svg',
                url: '/wp-content/themes/ananas/fe-assets/images/svg/dia_diem.svg',
                // This marker is 40 pixels wide by 61 pixels high.
                size: new google.maps.Size(40, 61),
                // The origin for this image is (0, 0).
                origin: new google.maps.Point(0, 0),
                // The anchor for this image is the base of the flagpole at (0, 61).
                anchor: new google.maps.Point(20, 61)
            };

    infoWindow = new google.maps.InfoWindow;

    // Try HTML5 geolocation.
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(function(position) {
            isAllow = true;
            pos = {lat: position.coords.latitude, lng: position.coords.longitude};

            RenderSpotShop(isAllow, pos);

        }, function() {
            // User dont allow get their location
            RenderSpotShop(isAllow);
        });
    }
    else
    {
        // Browser doesn't support Geolocation
        RenderSpotShop(isAllow);
    }
}

//----------------------------------------------------------------------------------------------------

function RenderSpotShop(isShowKM, posUser)
{
    if (dataShop.length > 0)
    {
        // var marker = new google.maps.Marker({position: posUser, map: map, icon: image_spot});
        // map.setCenter(posUser);

        dataShop = (isShowKM) ? SortNearByUserLocation(dataShop, posUser) : dataShop;

        CreateMarkers(dataShop);

        // set center neareast shop
        map.setCenter({lat: +dataShop[0].latitude, lng: +dataShop[0].longitude});

        //show infoWindow of neareast shop
        var content = FormatText(templateSpot, {
            shop_name:      dataShop[0].shop_name,
            shop_address:   dataShop[0].shop_address,
            shop_phone:     dataShop[0].shop_phone,
            shop_opentime:  dataShop[0].shop_opentime,
            shop_image:     dataShop[0].shop_image
        });
        infoWindow.setContent(content);
        infoWindow.open(map, arrMarker[0]);

        // append data to listshop
        RenderHtmlListShop( isShowKM ? SUCCESS : SUCCESS_NO_KM, posUser);
    }
    else
    {
        // append data to listshop
        RenderHtmlListShop(ERROR_SEARCH_NO_ITEM);

        //map.setCenter(posUser);
    }

    /*
    * The google.maps.event.addListener() event waits for
    * the creation of the infowindow HTML structure 'domready'
    * and before the opening of the infowindow defined styles
    * are applied.
    */
    google.maps.event.addListener(infoWindow, 'domready', function() {
        $('.gm-style-iw').prev().remove();                      // remove default bg
        $('.gm-style-iw').addClass('maps-spot-class');          // overwrite class of 'bg'
        $('.gm-ui-hover-effect').addClass('maps-spot-close');   // overwrite class of 'close button'
    });
}

//----------------------------------------------------------------------------------------------------

const SUCCESS                       = 0;
const SUCCESS_NO_KM                 = 1;
const ERROR_USER_BLOCK_LOCATION     = 2;
const ERROR_BROWSER_NO_SUPPORT_GEO  = 3;
const ERROR_SEARCH_NO_ITEM          = 4;

function RenderHtmlListShop(errorType, posUser)
{
    var htmlCont = "";
    var strNotice = "";

    switch (errorType)
    {
        case SUCCESS:
        {
            htmlCont += '<li class="list-group-item items">';
            for (var i=0; i<dataShop.length; i++)
            {
                // if (arrMarker[i].getVisible())
                // {
                var distKM = distance(dataShop[i].latitude, dataShop[i].longitude, posUser.lat, posUser.lng, 'K').toFixed(2) + '';
                var htmlTemp = FormatText(templateShop, {
                    title_class:    (i==0) ? "title" : "title-1",
                    spot_id:        i,
                    shop_name:      dataShop[i].shop_name,
                    shop_address:   dataShop[i].shop_address,
                    shop_phone:     dataShop[i].shop_phone,
                    shop_opentime:  dataShop[i].shop_opentime,
                    shop_type:      dataShop[i].shop_type_name,
                    shop_km:        distKM
                });

                htmlCont += htmlTemp;
                // }
            }
            htmlCont += '</li>';
            break;
        }
        case SUCCESS_NO_KM:
        {
            htmlCont += '<li class="list-group-item items">';
            for (var i=0; i<dataShop.length; i++)
            {
                // if (arrMarker[i].getVisible())
                // {
                var htmlTemp = FormatText(templateShopNoKM, {
                    title_class:    (i==0) ? "title" : "title-1",
                    spot_id:        i,
                    shop_name:      dataShop[i].shop_name,
                    shop_address:   dataShop[i].shop_address,
                    shop_phone:     dataShop[i].shop_phone,
                    shop_opentime:  dataShop[i].shop_opentime,
                    shop_type:      dataShop[i].shop_type_name
                });

                htmlCont += htmlTemp;
                // }
            }
            htmlCont += '</li>';
            break;
        }
        case ERROR_USER_BLOCK_LOCATION:
        {
            strNotice = "Bạn không cho phép lấy vị trí của bạn. Nên chúng tôi không thể tìm những cửa hàng gần bạn được. Xin vui lòng nhấn F5 và cho phép truy cập vị trí.";
            htmlCont = FormatText(templateNotice, {error_text: strNotice});
            break;
        }
        case ERROR_BROWSER_NO_SUPPORT_GEO:
        {
            strNotice = "Trình duyệt của bạn không hỗ trợ Geolocation. Chúng tôi không thể tìm những cửa hàng gần bạn. Xin vui lòng chọn trình duyệt khác!";
            htmlCont = FormatText(templateNotice, {error_text: strNotice});
            break;
        }
        case ERROR_SEARCH_NO_ITEM:
        {
            strNotice = "Xin lỗi, Dứa không tìm thấy loại cửa hàng bạn muốn tìm ở khu vực này!";
            htmlCont = FormatText(templateNotice, {error_text: strNotice});
            break;
        }
    }

    var htmlAppend = FormatText(templateTitle, {main_content: htmlCont});
    $('#store-list .list-group').html('');
    $('#store-list .list-group').append(htmlAppend);

    // show notice menu
    $('#store-list').removeClass('close');
    AddEventClick();
}
