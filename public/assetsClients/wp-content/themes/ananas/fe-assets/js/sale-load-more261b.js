$(document).ready(function() 
{    
    var url = (typeof ajaxUrl !== "undefined") ? ajaxUrl : 'https://ananasvn.com/staging/wp-admin/admin-ajax.php';
    var dummyData = {        
      "listProduct": [
        {
          "productID": 1884,
          "productName": "Ananas Abbey Stone - High Top",
          "productPrice": "450.000 VND",
          "promotion": {
            "priceProduct": 450000,
            "valuePromotion": 225000,
            "priceAfterPromotion": 225000,
            "textPriceAfterPromotion": "225.000 VND",
            "textValuePromotion": "50 %"
          },
          "productColor": "Abbey Stone",
          "productSKU": "A20212",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A20212.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 0,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a20212/"
        },
        {
          "productID": 1885,
          "productName": "Ananas Mocha Mousse - High Top",
          "productPrice": "450.000 VND",
          "promotion": {
            "priceProduct": 450000,
            "valuePromotion": 225000,
            "priceAfterPromotion": 225000,
            "textPriceAfterPromotion": "225.000 VND",
            "textValuePromotion": "50 %"
          },
          "productColor": "Mocha Mousse",
          "productSKU": "A20213",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A20213.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a20213/"
        },
        {
          "productID": 1886,
          "productName": "Ananas All Black - High Top",
          "productPrice": "450.000 VND",
          "promotion": {
            "priceProduct": 450000,
            "valuePromotion": 225000,
            "priceAfterPromotion": 225000,
            "textPriceAfterPromotion": "225.000 VND",
            "textValuePromotion": "50 %"
          },
          "productColor": "All Black",
          "productSKU": "A20214",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A20214.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a20214/"
        },
        {
          "productID": 1887,
          "productName": "Ananas All Black - Low Top",
          "productPrice": "360.000 VND",
          "promotion": {
            "priceProduct": 360000,
            "valuePromotion": 110000,
            "priceAfterPromotion": 250000,
            "textPriceAfterPromotion": "250.000 VND",
            "textValuePromotion": "110000 VND"
          },
          "productColor": "All Black",
          "productSKU": "A20215",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A20215.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a20215/"
        },
        {
          "productID": 1888,
          "productName": "Ananas Narcissus - High Top",
          "productPrice": "450.000 VND",
          "promotion": {
            "priceProduct": 450000,
            "valuePromotion": 225000,
            "priceAfterPromotion": 225000,
            "textPriceAfterPromotion": "225.000 VND",
            "textValuePromotion": "50 %"
          },
          "productColor": "Narcissus",
          "productSKU": "A20216",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A20216.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a20216/"
        },
        {
          "productID": 1969,
          "productName": "Ananas Red Dahlia - Slip On",
          "productPrice": "360.000 VND",
          "promotion": {
            "priceProduct": 360000,
            "valuePromotion": 180000,
            "priceAfterPromotion": 180000,
            "textPriceAfterPromotion": "180.000 VND",
            "textValuePromotion": "50 %"
          },
          "productColor": "Red Dahlia",
          "productSKU": "A60006",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60006.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60006/"
        },
        {
          "productID": 1985,
          "productName": "Urbas Lego Freesia - Slip On",
          "productPrice": "420.000 VND",
          "promotion": {
            "priceProduct": 420000,
            "valuePromotion": 126000,
            "priceAfterPromotion": 294000,
            "textPriceAfterPromotion": "294.000 VND",
            "textValuePromotion": "30 %"
          },
          "productColor": "Freesia",
          "productSKU": "A60022",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60022.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60022/"
        },
        {
          "productID": 2001,
          "productName": "Blank Shoes Lace",
          "productPrice": "35.000 VND",
          "promotion": "",
          "productColor": "Multicolor",
          "productSKU": "ALB",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/SHOELACES-1.gif"
            ],
            "type": "gif"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/alb/"
        },
        {
          "productID": 1970,
          "productName": "Ananas Discover Saigon Blue Radiance - Slip On",
          "productPrice": "390.000 VND",
          "promotion": "",
          "productColor": "Blue Radiance",
          "productSKU": "A60007",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60007.png",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "png"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60007/"
        },
        {
          "productID": 1986,
          "productName": "Urbas Lego Molten Lava - Slip On",
          "productPrice": "420.000 VND",
          "promotion": {
            "priceProduct": 420000,
            "valuePromotion": 84000,
            "priceAfterPromotion": 336000,
            "textPriceAfterPromotion": "336.000 VND",
            "textValuePromotion": "20 %"
          },
          "productColor": "Molten Lava",
          "productSKU": "A60023",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60023.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60023/"
        },
        {
          "productID": 1971,
          "productName": "Basas Blue N' Crème Dark Blue - Slip On",
          "productPrice": "360.000 VND",
          "promotion": {
            "priceProduct": 360000,
            "valuePromotion": 108000,
            "priceAfterPromotion": 252000,
            "textPriceAfterPromotion": "252.000 VND",
            "textValuePromotion": "30 %"
          },
          "productColor": "Dark Blue",
          "productSKU": "A60008",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60008.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60008/"
        },
        {
          "productID": 1987,
          "productName": "Vintas Military Dark Earth - High Top",
          "productPrice": "495.000 VND",
          "promotion": {
            "priceProduct": 495000,
            "valuePromotion": 99000,
            "priceAfterPromotion": 396000,
            "textPriceAfterPromotion": "396.000 VND",
            "textValuePromotion": "20 %"
          },
          "productColor": "Dark Earth",
          "productSKU": "A60024",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60024.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60024/"
        },
        {
          "productID": 1972,
          "productName": "Basas  Blue N' Crème Creme Brulee - Slip On",
          "productPrice": "360.000 VND",
          "promotion": {
            "priceProduct": 360000,
            "valuePromotion": 108000,
            "priceAfterPromotion": 252000,
            "textPriceAfterPromotion": "252.000 VND",
            "textValuePromotion": "30 %"
          },
          "productColor": "Creme Brulee",
          "productSKU": "A60009",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60009.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60009/"
        },
        {
          "productID": 1988,
          "productName": "Vintas Military Antique Bronze - High Top",
          "productPrice": "495.000 VND",
          "promotion": {
            "priceProduct": 495000,
            "valuePromotion": 49500,
            "priceAfterPromotion": 445500,
            "textPriceAfterPromotion": "445.500 VND",
            "textValuePromotion": "10 %"
          },
          "productColor": "Antique Bronze",
          "productSKU": "A60025",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60025.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60025/"
        },
        {
          "productID": 1973,
          "productName": "Basas Blue N' Crème Dark Blue - High Top",
          "productPrice": "450.000 VND",
          "promotion": {
            "priceProduct": 450000,
            "valuePromotion": 135000,
            "priceAfterPromotion": 315000,
            "textPriceAfterPromotion": "315.000 VND",
            "textValuePromotion": "30 %"
          },
          "productColor": "Dark Blue",
          "productSKU": "A60010",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60010.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60010/"
        },
        {
          "productID": 1989,
          "productName": "Vintas Military Arona - High Top",
          "productPrice": "495.000 VND",
          "promotion": {
            "priceProduct": 495000,
            "valuePromotion": 99000,
            "priceAfterPromotion": 396000,
            "textPriceAfterPromotion": "396.000 VND",
            "textValuePromotion": "20 %"
          },
          "productColor": "Arona",
          "productSKU": "A60026",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60026.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60026/"
        },
        {
          "productID": 1974,
          "productName": "Basas Blue N' Crème Creme Brulee - High Top",
          "productPrice": "450.000 VND",
          "promotion": {
            "priceProduct": 450000,
            "valuePromotion": 135000,
            "priceAfterPromotion": 315000,
            "textPriceAfterPromotion": "315.000 VND",
            "textValuePromotion": "30 %"
          },
          "productColor": "Creme Brulee",
          "productSKU": "A60011",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60011.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60011/"
        },
        {
          "productID": 1990,
          "productName": "Basas Familiar Black - Low Top",
          "productPrice": "420.000 VND",
          "promotion": {
            "priceProduct": 420000,
            "valuePromotion": 42000,
            "priceAfterPromotion": 378000,
            "textPriceAfterPromotion": "378.000 VND",
            "textValuePromotion": "10 %"
          },
          "productColor": "Black",
          "productSKU": "A60027",
          "productLabel": "Best Seller",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60027.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60027/"
        },
        {
          "productID": 1975,
          "productName": "Basas Blue N' Crème Dark Blue - Low Top ",
          "productPrice": "360.000 VND",
          "promotion": {
            "priceProduct": 360000,
            "valuePromotion": 108000,
            "priceAfterPromotion": 252000,
            "textPriceAfterPromotion": "252.000 VND",
            "textValuePromotion": "30 %"
          },
          "productColor": "Dark Blue",
          "productSKU": "A60012",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60012.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60012/"
        },
        {
          "productID": 1991,
          "productName": "Basas Familiar Marshmallow - Low Top",
          "productPrice": "420.000 VND",
          "promotion": {
            "priceProduct": 420000,
            "valuePromotion": 42000,
            "priceAfterPromotion": 378000,
            "textPriceAfterPromotion": "378.000 VND",
            "textValuePromotion": "10 %"
          },
          "productColor": "Marshmallow",
          "productSKU": "A60028",
          "productLabel": "",
          "media": {
            "link": [
              "https://ananasvn.com/wp-content/uploads/A60028.jpg",
              "https://ananasvn.com/wp-content/themes/ananas/assets/images/Logo_Ananas.png"
            ],
            "type": "jpg"
          },
          "statusQuantity": 2,
          "isLike": false,
          "linkBuyNow": "https://ananasvn.com/danh-sach-san-pham/a60028/"
        }
      ],
      "sumProduct": 103,
      "totalCurrentResult":20
    };

//------------------------------------------------------------------------------------------------------------
    
  function GetDataSale(page) 
  {
      var data = {};
      // var pID = $('#promotionID').html();
      var pSlug = $('#promotionSlug').html();
      
      data = {
          action: "getBestforMe",
          // promotionID: pID,
          promotionSlug: pSlug,
          paged: page
      };

      return data;
  }    

//------------------------------------------------------------------------------------------------------------
  var saleVar = {
            isLoading: false, 
            isLastPage: false, 
            currentIdx: 0, 
            currentPage: 2
          };

  function AjaxSaleLoadMore(isMobile)
  {
      saleVar.isLoading = true;
      $('.load-more-icon').show();

      var dataFilter = GetDataSale(saleVar.currentPage);

      $.ajax({
          type: 'GET',
          url: url,
          global: false,
          data: dataFilter,
          success: function(response) {
              //Do Something
              var dataRender = null;
              dataRender = response.listProduct;              

              if (dataRender != null && dataRender != "")
              {
                  renderHTMLSale(dataRender, isMobile, response.totalCurrentResult);
                  saleVar.currentPage++;
                  saleVar.isLastPage = false;
              }
              else
              {
                saleVar.isLastPage = true;
              }
              
              $('.load-more-icon').hide();
              saleVar.isLoading = false;
          },
          error: function(xhr) {
              // Do Something to handle error
              // var dataRender = null;
              // dataRender = dummyData.listProduct;              

              // if (dataRender != null && dataRender != "")
              // {
              //     renderHTMLSale(dataRender, isMobile, dummyData.totalCurrentResult);
              //     saleVar.currentPage++;
              //     saleVar.isLastPage = false;
              // }
              // else
              // {
              //   saleVar.isLastPage = true;
              // }              
              
              // if (saleVar.currentPage > 3)
              // {
              //     saleVar.isLastPage = true;
              // }

              $('.load-more-icon').hide();
              saleVar.isLoading = false;
          }
      });
  }

//------------------------------------------------------------------------------------------------------------  

  function renderHTMLSale(data, isMobile, itemsPerPage)
  {
      var htmlProduct = '';

      if (saleVar.currentIdx == 0)
      {
        saleVar.currentIdx = itemsPerPage;
      }

      data.forEach( function (item) {

          if (( (saleVar.currentIdx) % 3 == 0 && !isMobile) ||
              ( (saleVar.currentIdx) % 2 == 0 && isMobile))
          {      
              if(saleVar.currentIdx > 0)
              {
                htmlProduct +=  '<div class="item-break"></div>';
              }
          }
          saleVar.currentIdx++;

          htmlProduct +=  '<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">';
          htmlProduct +=          '<div class="thumbnail">';          
          htmlProduct +=              '<div class="cont-item">';          
        
          if (item.isBuyOnline)
          {
              htmlProduct +=              '<div class="tag-grey">Online Only</div>';
          }
          else if (item.isLimitedEdition)
          {
              htmlProduct +=              '<div class="tag-blue">Limited Edition</div>';
          }

          if (item.statusQuantity <= 0)
          {
              htmlProduct +=              '<div class="soldout-text">HẾT HÀNG</div>';
              htmlProduct +=              '<a href="'+item.linkBuyNow+'"><div class="black-rect"></div></a>';
          }
          
          if (item.media.type == 'video')
          {
              htmlProduct +=              '<a href="'+item.linkBuyNow+'"><video class="videoFullHeight" autoplay muted>';
              htmlProduct +=                  '<source src="' + item.media.link + '" type="video/mp4">';
              htmlProduct +=                  'Your browser does not support the video tag.';
              htmlProduct +=              '</video></a>';
          }
          else if (item.media.type == 'gif')
          {
              htmlProduct +=              '<a href="'+item.linkBuyNow+'"><img src="' + item.media.link + '"></a>';
          }
          else
          {
            if (isMobile)
            {
              htmlProduct +=              '<a href="'+item.linkBuyNow+'"><img src="' + item.media.link[0] + '"></a>';
            }
            else
            {
              if (item.media.link.length > 1)
              {
                htmlProduct +=              '<a href="'+item.linkBuyNow+'"><img class="inormal" src="' + item.media.link[0] + '">';
                htmlProduct +=              '<img class="ihover" src="' + item.media.link[1] + '"></a>';
              }
              else if (item.media.link.length == 1)
              {
                htmlProduct +=              '<a href="'+item.linkBuyNow+'"><img class="inormal" src="' + item.media.link[0] + '">';
                htmlProduct +=              '<img class="ihover" src="' + item.media.link[0] + '"></a>';
              }
            }
          }
          htmlProduct +=              '</div>';

          htmlProduct +=              '<div class="button">';
          
          
          if (item.statusQuantity > 0) 
          {
              htmlProduct +=              '<a class="btn btn-prd1-buynow hidden-xs hidden-sm" href="'+item.linkBuyNow+'">MUA NGAY</a>';
          }

          if (item.isLike)
          {
              htmlProduct +=              '<a class="addToWishList btn btn-prd1-heart-active" href="javascript:void(0)" data-liked="true" data-action="removeProductWishList" data-idproduct="' + item.productID + '"></a>';
          }
          else
          {
              htmlProduct +=              '<a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)" data-liked="false" data-action="transferCartToWishList" data-idproduct="' + item.productID + '"></a>';
          }          
          
          htmlProduct +=              '</div>';
          htmlProduct +=              '<div class="caption">';
                    
          if (item.productLabel.trim() == "")
          {
              // htmlProduct +=              '<h3 class="type">&nbsp;</h3>';
              htmlProduct +=              '';
          }
          else
          {
              htmlProduct +=              '<h3 class="type">' + item.productLabel + '</h3>';
              htmlProduct +=              '<h3 class="divider"></h3>';
          }
                      
          htmlProduct +=                  '<h3 class="name"><a href="'+item.linkBuyNow+'">' + item.productName + '</a></h3>';

          if (item.productColor.trim() == "")
          {              
              htmlProduct +=              '';
          }
          else
          {
              htmlProduct +=              '<h3 class="color">' + item.productColor + '</h3>';
          }            
          
          if (typeof item.promotion !== "undefined" && item.promotion !="")
          {
              htmlProduct +=              '<h3 class="price">' + item.promotion.textPriceAfterPromotion;
              if (item.promotion.priceAfterPromotion != item.promotion.priceProduct )
              {
                  htmlProduct += '                <span class="price-real">'+ item.productPrice +'</span>';
              }
          }
          else
          {
              htmlProduct +=              '<h3 class="price">' + item.productPrice;
          }            
          
          htmlProduct += '                </h3>';

          htmlProduct +=              '</div>';
          htmlProduct +=      '</div>';
          htmlProduct +=  '</div>';

          
      });

      $(htmlProduct).hide().appendTo(".prd1-right-items").fadeIn(1000);
  }

//------------------------------------------------------------------------------------------------------------

  // Run on PC    
  $(window).scroll( function() {       
      // Call ajax loadmore
      if (saleVar.isLoading) return;
      if ($(window).scrollTop() + $(window).height() >= 
      $('.prd1-right-items').offset().top + $('.prd1-right-items').height() ) 
      {
          if (!saleVar.isLastPage)
          {            
              AjaxSaleLoadMore(window.innerWidth < 992);
          }
      }
  });
});