define(function () {
    return {
        templates: {
            // Docs https://support.google.com/merchants/answer/7052112?hl=ru
            google_shopping: function() {
                return  "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n" +
                    "<rss version=\"2.0\" xmlns:g=\"http://base.google.com/ns/1.0\">\n" +
                    "  <channel>\n" +
                    "    <title>Data feed Example</title>\n" +
                    "    <link>{{ template.web_url }}</link>\n" +
                    "    <description>Data feed description.</description>\n" +
                    "    {% for product in set %}\n" +
                    "       <item>\n" +
                                // From 1 to 50 chars. SKU code is recommended. Required.
                    "           <g:id><![CDATA[{{ product.sku | substr(0, 50)}}]]></g:id>\n" +

                                // From 1 to 150 chars. Required.
                    "           <g:title><![CDATA[{{ product.name | substr(0, 150) }}]]></g:title>\n" +

                                // From 1 to 5000 chars. HTML tags should be encoded. Required.
                    "           <g:description><![CDATA[{{ product.description | htmlspecialchars() }}]]></g:description>\n" +

                                // From 1 to 2000 chars. Absolute url. Required.
                    "           <link><![CDATA[{{ template.web_url }}{{ product.url_key }}]]></link>\n" +

                                // From 1 to 2000 chars. Only gif, jpg/.jpeg, png, bmp, tif/tiff. Required.
                    "           <g:image_link><![CDATA[{{ template.media_url }}catalog/product{{ product.base_image }}]]></g:image_link>\n" +

                                // Max "additional_image_link" 10 rows. Rules the same as for image_link. Optional.
                    "           {% for image in set %}\n" +
                    "               <g:additional_image_link><![CDATA[{{ template.media_url }}catalog/product{{ src }}]]></g:additional_image_link>\n" +
                    "           {% endforImage %}\n" +

                                // Same rules as for "link". Optional.
                    "           <g:mobile_link><![CDATA[{{ template.web_url }}{{ product.url_key }}]]></g:mobile_link>\n" +

                                // Can be: "in stock", "out of stock", "preorder". Required.
                    "           {% if product.is_in_stock == 1 %}\n" +
                    "               <g:availability><![CDATA[in stock]]></g:availability>\n" +
                    "           {% endif %}\n" +
                    "           {% if product.is_in_stock == 0 %}\n" +
                    "               <g:availability><![CDATA[out of stock]]></g:availability>\n" +
                    "           {% endif %}\n" +

                                // Product price. Currency format ISO 4217. Example 1500.00 RUB. Required.
                    "           <g:price>{{ product.price }} {{ template.store_currency }}</g:price>\n" +

                                // Category id or category named path. List of values is predefined by google:
                                // https://www.google.com/basepages/producttype/taxonomy-with-ids.en-US.txt
                                // There can be only one category per product. We should pick the most suitable
                    "           <g:google_product_category>{{ product.categories }}</g:google_product_category>\n" +

                                // From 1 to 70 chars. Required.
                    "           <g:brand><![CDATA[{{ product.name }}]]></g:brand>\n" +

                                // From 1 to 70 chars. Required for products without gtin.
                    "           <g:mpn><![CDATA[{{ product.sku }}]]></g:mpn>\n" +

                                // Valid values: "new", "refurbished", "used". Optional for new products
                    "           <g:condition>new</g:condition>\n" +
                    "       </item>\n" +
                    "    {% endforProduct %}\n" +
                    "  </channel>\n" +
                    "</rss>";
            },
        },

        // Variable modifiers
        modifiers: [
            {
                label: "trim",
                value: "trim(' ')",
                tooltip: "Remove listed chars from beginning and end of the string"
            },
            {
                label: "ltrim",
                value: "ltrim(' ')",
                tooltip: "Remove listed chars from beginning of the string"
            },
            {
                label: "rtrim",
                value: "rtrim(' ')",
                tooltip: "Remove listed chars from end of the string"
            },
            {
                label: "htmlspecialchars",
                value: "htmlspecialchars()",
                tooltip: "Encode html by doing replace of HTML tag braces: > <"
            },
            {
                label: "strip_tags",
                value: "strip_tags('<ul><li>')",
                tooltip: "Remove all HTML tags, except listed"
            },
            {
                label: "substr",
                value: "substr(0, 50)",
                tooltip: "Take substring of longer string. 2 arguments: start char and end char"
            },
            {
                label: "ucfirst",
                value: "ucfirst()",
                tooltip: "Make first letter of string capitalized"
            },
            {
                label: "str_replace",
                value: "str_replace()",
                tooltip: "Find and replace"
            },
            {
                label: "floor",
                value: "floor()",
                tooltip: "Round fractions down"
            },
            {
                label: "ceil",
                value: "ceil()",
                tooltip: "Round fractions up"
            },
            {
                label: "round",
                value: "round()",
                tooltip: "Rounds a float"
            },
            {
                label: "nl2br",
                value: "nl2br()",
                tooltip: "Text line break into &lt;br&lt; tag"
            },
            {
                label: "removeLineBreaks",
                value: "removeLineBreaks()",
                tooltip: "Remove all line breaks from string"
            }
        ],
    };
});
