$(document).ready(function()
{
    var url = (typeof ajaxUrl !== "undefined") ? ajaxUrl : 'https://ananasvn.com/staging/wp-admin/admin-ajax.php';
    var dummyData = {
        "Sex": [
          {
            "id": 780,
            "name": "NAM",
            "slug": "men"
          },
          {
            "id": 781,
            "name": "NỮ",
            "slug": "women"
          }
        ],
        "Category": {
          "men": [
            {
              "id": 782,
              "name": "Giày",
              "slug": "shoes"
            },
            {
              "id": 785,
              "name": "Phụ kiện",
              "slug": "accessories"
            }
          ],
          "women": [
            {
              "id": 782,
              "name": "Giày",
              "slug": "shoes"
            },
            {
              "id": 785,
              "name": "Phụ kiện",
              "slug": "accessories"
            }
          ],
          "all": [
            {
              "id": 782,
              "name": "Giày",
              "slug": "shoes"
            },
            {
              "id": 785,
              "name": "Phụ kiện",
              "slug": "accessories"
            }
          ]
        },
        "Attribute": {
          "1": {
            "term_id": "6402",
            "name": "TRẠNG THÁI",
            "slug": "trang-thai",
            "parent": "0",
            "template_html": "template_html1",
            "type": "text",
            "child": [
              {
                "term_id": "6403",
                "name": "New Arrival",
                "slug": "new-arrival",
                "parent": "6402",
                "isChecked": false
              },
              {
                "term_id": "6404",
                "name": "Best Seller",
                "slug": "best-seller",
                "parent": "6402",
                "isChecked": false
              },
              {
                "term_id": "6405",
                "name": "Pre-order",
                "slug": "pre-order",
                "parent": "6402",
                "isChecked": false
              }
            ]
          },
          "2": {
            "term_id": "776",
            "name": "KIỂU DÁNG",
            "slug": "type",
            "parent": "0",
            "template_html": "template_html1",
            "type": "text",
            "child": [
              {
                "term_id": "777",
                "name": "High Top",
                "slug": "high-top",
                "parent": "776",
                "isChecked": false
              },
              {
                "term_id": "778",
                "name": "Low Top",
                "slug": "low-top",
                "parent": "776",
                "isChecked": false
              },
              {
                "term_id": "3793",
                "name": "Slip-on",
                "slug": "slip-on",
                "parent": "776",
                "isChecked": false
              }
            ]
          },
          "3": {
            "term_id": "773",
            "name": "DÒNG SẢN PHẨM",
            "slug": "dong-san-pham",
            "parent": "0",
            "template_html": "template_html1",
            "type": "text",
            "child": [
              {
                "term_id": "775",
                "name": "Vintas",
                "slug": "vintas",
                "parent": "773",
                "isChecked": false
              },
              {
                "term_id": "779",
                "name": "Basas",
                "slug": "basas",
                "parent": "773",
                "isChecked": false
              },
              {
                "term_id": "3010",
                "name": "Urbas",
                "slug": "urbas",
                "parent": "773",
                "isChecked": false
              },
              {
                "term_id": "6407",
                "name": "Cap",
                "slug": "cap",
                "parent": "773",
                "isChecked": false
              },
              {
                "term_id": "6408",
                "name": "Shoes Lace",
                "slug": "shoes-lace",
                "parent": "773",
                "isChecked": false
              }
            ]
          },
          "4": {
            "term_id": "6427",
            "name": "GIÁ",
            "slug": "range-price",
            "parent": "0",
            "template_html": "template_html1",
            "type": "text",
            "child": [
              {
                "term_id": "6428",
                "name": "&lt; 200k",
                "slug": "200k-range-price",
                "parent": "6427",
                "isChecked": false
              },
              {
                "term_id": "6429",
                "name": "200k - 299k",
                "slug": "200-299k",
                "parent": "6427",
                "isChecked": false
              },
              {
                "term_id": "6430",
                "name": "300k - 399k",
                "slug": "300-399k",
                "parent": "6427",
                "isChecked": false
              },
              {
                "term_id": "6431",
                "name": "400k - 499k",
                "slug": "400-499k",
                "parent": "6427",
                "isChecked": false
              },
              {
                "term_id": "6437",
                "name": "500k - 600k",
                "slug": "500-600k",
                "parent": "6427",
                "isChecked": false
              },
              {
                "term_id": "6438",
                "name": "&gt; 600k",
                "slug": "600k",
                "parent": "6427",
                "isChecked": false
              }
            ]
          },
          "9223372036854775800": {
            "term_id": "6439",
            "name": "SIZE",
            "slug": "size-product",
            "parent": "0",
            "template_html": "template_html2",
            "type": "size",
            "child": [
              {
                "term_id": "6440",
                "name": "FR",
                "slug": "free",
                "parent": "6439",
                "isChecked": false
              }
            ]
          },
          "9223372036854775801": {
            "term_id": "6432",
            "name": "CHẤT LIỆU",
            "slug": "material",
            "parent": "0",
            "template_html": "template_html1",
            "type": "text",
            "child": [
              {
                "term_id": "6433",
                "name": "Canvas | Vải",
                "slug": "canvas",
                "parent": "6432",
                "isChecked": false
              },
              {
                "term_id": "6434",
                "name": "Synthetic Leather",
                "slug": "pu",
                "parent": "6432",
                "isChecked": false
              },
              {
                "term_id": "6435",
                "name": "Suede | Da lộn",
                "slug": "suede",
                "parent": "6432",
                "isChecked": false
              }
            ]
          },
          "9223372036854775803": {
            "term_id": "6414",
            "name": "SIZE GIÀY",
            "slug": "shoes-size",
            "parent": "0",
            "template_html": "template_html2",
            "type": "size",
            "child": [
              {
                "term_id": "6415",
                "name": "35",
                "slug": "35",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6416",
                "name": "36",
                "slug": "36",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6417",
                "name": "37",
                "slug": "37",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6418",
                "name": "38",
                "slug": "38",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6419",
                "name": "39",
                "slug": "39",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6420",
                "name": "40",
                "slug": "40",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6421",
                "name": "41",
                "slug": "41",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6422",
                "name": "42",
                "slug": "42",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6423",
                "name": "43",
                "slug": "43",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6424",
                "name": "44",
                "slug": "44",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6425",
                "name": "45",
                "slug": "45",
                "parent": "6414",
                "isChecked": false
              },
              {
                "term_id": "6426",
                "name": "46",
                "slug": "46",
                "parent": "6414",
                "isChecked": false
              }
            ]
          },
          "9223372036854775804": {
            "term_id": "6409",
            "name": "MÀU SẮC",
            "slug": "color",
            "parent": "0",
            "template_html": "template_html3",
            "type": "color",
            "child": [
              {
                "term_id": "6410",
                "name": "#0c0c0b",
                "slug": "black",
                "parent": "6409",
                "isChecked": false
              },
              {
                "term_id": "6411",
                "name": "#87061f",
                "slug": "red",
                "parent": "6409",
                "isChecked": false
              }
            ]
          }
        },
        "listProduct": null,
        "listProduct1": [
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
        "totalCurrentResult":20,
        "stringQuery": "product-list/?gender=nam"
    };

//------------------------------------------------------------------------------------------------------------
    var linkAddress = "";
    function ChangeUrl(sUrl)
    {
        if (typeof (history.pushState) != "undefined") {
            try {
                window.history.pushState("", "", sUrl);
            } catch (e) {}
        } else {
            console.log("Browser does not support HTML5.");
        }
    }

    // PC: click category
    $('.left-type-item li').click(function() {
        $(this).toggleClass("current");
        AjaxLoadProduct(false, true);
    });

    // PC: click tab gender
    $('.prd1-left .left-type a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      // var target = $(e.target).attr("href") // activated tab
      AjaxLoadProduct(false, true);
    });

    // Mobile: click tab gender
    $('.filter-mobile .title-main a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        AjaxLoadProduct(true, true);
    });

    // Mobile: click category
    $('.filter-mobile .tab ul.nav-tabs li').click(function () {
        $(this).toggleClass("active");
        AjaxLoadProduct(true, true);
    });

    $('.filter-mobile .tab-content .option').click(function () {
        var isOpen = $(this).hasClass("collapsed");
        if (isOpen === true)
        {
            $(".row.prd1-right-items").addClass("hidden");
            $(".load-more-icon").addClass("hidden");

            $(".footer-mobile").removeClass("visible-xs visible-sm");
            $(".footer-mobile").addClass("hidden");

            $(".filter-mobile .btn-clear").removeClass("hidden");
            $(".filter-mobile .btn-filter").removeClass("hidden");
        }
        else
        {
            $(".row.prd1-right-items").removeClass("hidden");
            $(".load-more-icon").removeClass("hidden");

            $(".footer-mobile").addClass("visible-xs visible-sm");
            $(".footer-mobile").removeClass("hidden");

            $(".filter-mobile .btn-clear").addClass("hidden");
            $(".filter-mobile .btn-filter").addClass("hidden");
        }
    });

    $('.filter-mobile .btn-clear').click(function() {
        ClearAllAttribute();
    });

    $('.filter-mobile .btn-filter').click(function() {
        $('.filter-mobile .left-tree-mobile.collapse').collapse('hide');
        $(".row.prd1-right-items").removeClass("hidden");
        $(".load-more-icon").removeClass("hidden");

        $(".footer-mobile").addClass("visible-xs visible-sm");
        $(".footer-mobile").removeClass("hidden");

        $(".filter-mobile .btn-clear").addClass("hidden");
        $(".filter-mobile .btn-filter").addClass("hidden");

        AjaxLoadProduct(true, false);
    });

    AddEventClick();
    function AddEventClick()
    {
        $('.prd1-left .cb-item').click(function() {
            AjaxLoadProduct(false, false);
        });

        $('.prd1-left .cb-size input').click(function() {
            AjaxLoadProduct(false, false);
        });

        $('.prd1-left .cb-color input').click(function() {
            AjaxLoadProduct(false, false);
        });

        //--------------------------------------------------------
        $('.filter-mobile .tree-toggle').click(function () {
            var isDislay = $(this).parent().children('ul.tree').css('display');
            if (isDislay == 'block')
            {
                $(this).parent().find('.caret').addClass('caret-normal');
                $(this).parent().find('.caret').removeClass('caret-active');
                $(this).parent().find('.nav-header').removeClass('orange');
            }
            else
            {
                $(this).parent().find('.caret').addClass('caret-active');
                $(this).parent().find('.caret').removeClass('caret-normal');
                $(this).parent().find('.nav-header').addClass('orange');
            }

            $(this).parent().children('ul.tree').toggle(200);
        });

        $('.left-tree .tree-toggle').click(function () {
            var isDislay = $(this).parent().children('ul.tree').css('display');
            if (isDislay == 'block')
            {
                $(this).parent().find('.caret').addClass('caret-normal');
                $(this).parent().find('.caret').removeClass('caret-active');
                $(this).parent().find('.nav-header').removeClass('orange');
            }
            else
            {
                $(this).parent().find('.caret').addClass('caret-active');
                $(this).parent().find('.caret').removeClass('caret-normal');
                $(this).parent().find('.nav-header').addClass('orange');
            }

            $(this).parent().children('ul.tree').toggle(200);
        });

        $('.cb-item').click(function() {
            if ($(this).is(':checked')) {
                $(this).parent().addClass("cb-checked");
            }
            else
            {
                $(this).parent().removeClass("cb-checked");
            }
        });
        // Handle event 'click' to choose Size
        $('.cb-size input').click(function() {
            if ($(this).is(':checked'))
            {
                $(this).parent().addClass("cb-size-checked");
            }
            else
            {
                $(this).parent().removeClass("cb-size-checked");
            }
        });
        // Handle event 'click' to choose Color
        $('.cb-color input').click(function() {
            if ($(this).is(':checked'))
            {
                $(this).parent().addClass("cb-color-checked");
            }
            else
            {
                $(this).parent().removeClass("cb-color-checked");
            }
        });
    }

//------------------------------------------------------------------------------------------------------------

    function ClearAllAttribute()
    {
        $('.filter-mobile .cb-item:checked').each(function(i, e) {
            $(e).parent().removeClass("cb-checked");
            $(e).prop('checked', false);
        });

        $('.filter-mobile .cb-size input:checked').each(function(i, e) {
            $(e).parent().removeClass("cb-size-checked");
            $(e).prop('checked', false);
        });

        $('.filter-mobile .cb-color input:checked').each(function(i, e) {
            $(e).parent().removeClass("cb-color-checked");
            $(e).prop('checked', false);
        });
    }

//------------------------------------------------------------------------------------------------------------

    function GetDataFilter(type, page, isMobile, isRenderAttribute)
    {
        var data = {};
        var aSex = (isMobile) ? $('.title-main').find('li.active').attr('data-id') : $('.left-type').find('li.active').attr('data-id');
        var aCategory = [];

        if (isMobile)
        {
            $('.tab .mb-category .tab-pane.active').find('li.active').each(function(i, e) { aCategory.push( $(e).attr('data-id')); });
        }
        else
        {
            $('.left-type-item .active').find('li.current').each(function(i, e) { aCategory.push( $(e).attr('data-id')); });
        }

        switch (type)
        {
            // case "attribute":
            // {
            //     data = {
            //         action: "filterattributebycategory",
            //         sex: aSex,
            //         category: aCategory
            //     };
            //     break;
            // }
            case "product":
            {
                var aAttribute = [];

                $("input[name='cbStatus']:checked").each(function(i, e) { aAttribute.push($(e).val()); });
                $("input[name='cbStyle']:checked").each(function(i, e) { aAttribute.push($(e).val()); });
                $("input[name='cbProducStyle']:checked").each(function(i, e) { aAttribute.push($(e).val()); });
                $("input[name='cbSize']:checked").each(function(i, e) { aAttribute.push($(e).val()); });
                $("input[name='cbColor']:checked").each(function(i, e) { aAttribute.push($(e).val()); });

                var pGender = aSex;
                var pCategory = (aCategory.length > 0) ? aCategory.join(',') : "";
                var pAttribute = (aAttribute.length > 0) ? aAttribute.join(',') : "";
                if (isRenderAttribute)
                {
                  pAttribute = "";
                }

                data = {
                    action: "filterFollow",
                    gender: pGender,
                    category: pCategory,
                    attribute: pAttribute,
                    relation: "and",
                    paged: page
                };
                break;
            }
        }

        return data;
    }

//------------------------------------------------------------------------------------------------------------
    function RemoveContentProduct()
    {
        $(".prd1-right-items").empty();
    }

    function AjaxLoadProduct(isMobile, isRenderAttribute)
    {
        RemoveContentProduct();
        $('.loading-filter').show();
        isLoading = true;

        currentPage = 2;
        var dataFilter = GetDataFilter("product", 1, isMobile, isRenderAttribute);

        $.ajax({
            type: 'GET',
            url: url,
            global: false,
            data: dataFilter,
            success: function(response) {
                //Do Something
                if (response.listProduct != null && response.listProduct.length > 0)
                {
                    if (isMobile)
                    {
                        $('.filter-mobile .tab-content .txt-countproduct').html(response.sumProduct + ' Sản phẩm');
                    }

                    if (isRenderAttribute)
                    {
                        renderHTMLAttribute(response.Attribute, isMobile);
                    }
                    renderHTMLProduct(response.listProduct, true, response.totalCurrentResult);
                    if (typeof response.stringQuery !== "undefined")
                    {
                        linkAddress = response.stringQuery;
                        ChangeUrl('/' + linkAddress);
                    }
                }
                ggTrackingImpressions(response.listProduct, true);

                $('.loading-filter').hide();
                isLoading = false;
                isLastPage = false;
            },
            error: function(xhr) {
                //Do Something to handle error
                // if (isMobile)
                // {
                //     $('.filter-mobile .tab-content .txt-countproduct').html(dummyData.sumProduct + ' Sản phẩm');
                // }

                // if (isRenderAttribute)
                // {
                //     renderHTMLAttribute(dummyData.Attribute, isMobile);
                // }
                // renderHTMLProduct(dummyData.listProduct1, true, dummyData.totalCurrentResult);
                // if (typeof dummyData.stringQuery !== "undefined")
                // {
                //     linkAddress = dummyData.stringQuery;
                //     ChangeUrl('/' + linkAddress);
                // }

                $('.loading-filter').hide();
                isLoading = false;
                isLastPage = false;
            }
        });
    }

//------------------------------------------------------------------------------------------------------------

    var isLoading = false;
    var isLastPage = false;
    var currentPage = 2;
    var currentIdx = 0;
    function AjaxLoadMore(isMobile)
    {
        isLoading = true;
        $('.load-more-icon').show();

        var dataFilter = GetDataFilter("product", currentPage, isMobile, false);

        $.ajax({
            type: 'GET',
            url: url,
            global: false,
            data: dataFilter,
            success: function(response) {
                //Do Something
                if (response.listProduct != null && response.listProduct.length > 0)
                {
                    renderHTMLProduct(response.listProduct, false, response.totalCurrentResult);
                    currentPage++;
                    isLastPage = false;
                    ggTrackingImpressions(response.listProduct, true);
                }
                else
                {
                    isLastPage = true;
                }

                $('.load-more-icon').hide();
                isLoading = false;
            },
            error: function(xhr) {
                // Do Something to handle error
                // if (dummyData.listProduct1 != null && dummyData.listProduct1.length > 0)
                // {
                //     renderHTMLProduct(dummyData.listProduct1, false, dummyData.totalCurrentResult);
                // }

                // currentPage++;
                // if (currentPage > 3)
                //     isLastPage = true;
                // else
                //     isLastPage = false;

                $('.load-more-icon').hide();
                isLoading = false;
            }
        });
    }

//------------------------------------------------------------------------------------------------------------

    function renderHTMLAttribute(listAttribute, isMobile)
    {

        if (isMobile)
        {
            $('.filter-mobile .left-tree-mobile ul').remove();
        }
        else
        {
            $('.prd1-left .left-tree ul').remove();
        }

        var htmlAttr =  '<ul class="nav">';

        Object.values(listAttribute).forEach( function(attr, idx, all) {

            htmlAttr +=  '<li class="first-lvl">';
            htmlAttr +=  '    <label label-default="" class="tree-toggle nav-header orange">'+ attr.name +' <span class="caret caret-active"></span></label>';
            htmlAttr +=  '    <ul class="nav tree">';

            if (attr.type == 'text')
            {
                Object.values(attr.child).forEach( function(item) {
                    htmlAttr += '<li>';
                    htmlAttr += (item.isChecked) ? '<label class="cb-checked">' : '<label>';
                    htmlAttr += '        <input name="cbStatus" class="cb-item" type="checkbox" value="'+ item.slug +'" '+ ((item.isChecked)?"checked":"") +' hidden>'+ item.name +' ';
                    htmlAttr += '        <span class="glyphicon"></span>';
                    htmlAttr += '    </label>';
                    htmlAttr += '</li>';
                });

                // attr.child.forEach ( function(item) {
                //     htmlAttr += '<li>';
                //     htmlAttr += (item.isChecked) ? '<label class="cb-checked">' : '<label>';
                //     htmlAttr += '        <input name="cbStatus" class="cb-item" type="checkbox" value="'+ item.slug +'" '+ ((item.isChecked)?"checked":"") +' hidden>'+ item.name +' ';
                //     htmlAttr += '        <span class="glyphicon"></span>';
                //     htmlAttr += '    </label>';
                //     htmlAttr += '</li>';
                // });
            }
            else if (attr.type == 'size')
            {
                htmlAttr += '<li class="cb-size">';

                Object.values(attr.child).forEach( function(item) {
                    htmlAttr += (item.isChecked) ? '<label class="cb-size-checked">' : '<label>';
                    htmlAttr += '<input name="cbSize" type="checkbox" value="'+ item.slug +'" '+ ((item.isChecked)?"checked":"") +' hidden>'+ item.name;
                    htmlAttr += '</label>';
                });
                // attr.child.forEach ( function (item) {
                //     htmlAttr += (item.isChecked) ? '<label class="cb-size-checked">' : '<label>';
                //     htmlAttr += '<input name="cbSize" type="checkbox" value="'+ item.slug +'" '+ ((item.isChecked)?"checked":"") +' hidden>'+ item.name;
                //     htmlAttr += '</label>';
                // });

                htmlAttr += '</li>';
            }
            else if (attr.type == 'color')
            {
                htmlAttr += '<li class="cb-color">';

                Object.values(attr.child).forEach( function(item) {
                    htmlAttr += (item.isChecked) ? '<label class="cb-color-checked">' : '<label>';
                    htmlAttr += '<span class="bg-color" style="background-color: #'+ item.name +';"></span><input name="cbColor" type="checkbox" value="'+ item.slug +'" '+ ((item.isChecked)?"checked":"") +' hidden>';
                    htmlAttr += '</label>';
                });
                // attr.child.forEach ( function (item) {
                //     htmlAttr += (item.isChecked) ? '<label class="cb-color-checked">' : '<label>';
                //     htmlAttr += '<span class="bg-color" style="background-color: '+ item.name +';"></span><input name="cbColor" type="checkbox" value="'+ item.slug +'" '+ ((item.isChecked)?"checked":"") +' hidden>';
                //     htmlAttr += '</label>';
                // });

                htmlAttr += '</li>';
            }

            htmlAttr +=  '    </ul>';
            htmlAttr +=  '</li>';

            if (    !isMobile ||
                    (isMobile && (idx < all.length - 1))   )
            {
                htmlAttr +=  '<li class="nav-divider"></li>';
            }
        });
        htmlAttr +=     '</ul>';


        if (isMobile)
        {
            $(htmlAttr).hide().appendTo(".filter-mobile .left-tree-mobile").fadeIn(1000);
        }
        else
        {
            $(htmlAttr).hide().appendTo(".prd1-left .left-tree").fadeIn(1000);
        }
        AddEventClick();
    }

//------------------------------------------------------------------------------------------------------------

    function renderHTMLProduct(listProduct, isRemoveContent, totalCurrentResult)
    {
        var isMobile = (window.innerWidth < 992);
        if (isRemoveContent)
        {
            currentIdx = 0;
            RemoveContentProduct();
        }
        else if (currentPage == 2)
        {
            currentIdx = totalCurrentResult;
        }

        var htmlProduct = '';
        listProduct.forEach( function (item, index) {

            if (  (currentIdx % 3 == 0 && !isMobile) ||
                  (currentIdx % 2 == 0 && isMobile)  )
            {
                htmlProduct +=  '<div class="item-break"></div>';
            }
            currentIdx++;

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
            else if (item.media.type == 'jpg' || item.media.type == 'png' || item.media.type == 'jpeg')
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
            else if (item.media.type == 'gif')
            {
                htmlProduct +=              '<a href="'+item.linkBuyNow+'"><img src="' + item.media.link + '"></a>';
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
                // htmlProduct +=              '<h3 class="color">&nbsp;</h3>';
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

        // Show Gotop button
        if ($(window).scrollTop() > 500)
        {
            // $('.gotop').show();
            $('.gotop').fadeIn(500);
        }
        else
        {
            // $('.gotop').hide();
            $('.gotop').fadeOut(500);
        }

        // Call ajax loadmore
        if (isLoading) return;
        if ($(window).scrollTop() + $(window).height() >=
        $('.prd1-right-items').offset().top + $('.prd1-right-items').height() )
        {
            if (!isLastPage)
            {
                var isMobile = (window.innerWidth < 992);
                var isOpenFilterMobile = $('.filter-mobile .tab-content .option').hasClass("collapsed");
                if (!isOpenFilterMobile && isMobile) return;
                AjaxLoadMore(window.innerWidth < 992);
            }
        }
    });

    // //Run on Mobile
    // $('body').bind('touchmove', function(e) {

    //     // Call ajax loadmore
    //     if (isLoading) return;
    //     if ($(window).scrollTop() + $(window).height() >=
    //     $('.prd1-right-items').offset().top + $('.prd1-right-items').height() )
    //     {
    //         if (!isLastPage)
    //         {
    //             AjaxLoadMore();
    //         }
    //     }
    // });

    // tracking 1st list product
    (function AjaxGet1stListProduct(){
      var isMobile = (window.innerWidth < 992);
      var dataFilter = GetDataFilter("product", 1, isMobile, false);

      $.ajax({
          type: 'GET',
          url: url,
          global: false,
          data: dataFilter,
          success: function(response) {
              //Do Something
              ggTrackingImpressions(response.listProduct, true);
          },
          error: function(xhr) {
              //Do Something to handle error
          }
      });
    })();

});
