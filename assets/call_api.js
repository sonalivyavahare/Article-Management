import config from './config.js';
let vars = config();

export default class AjaxCall {

    call(method, slug, requestData) {
        const result = $.ajax({
            type: method,
            url: vars.baseApiUrl + slug,
            data: requestData,
            success: function (data) {},
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                return false;
                throw data;
            },
            dataType: "json",
        });
        return result;
    }
}