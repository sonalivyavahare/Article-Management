import config from './config.js';
let vars = config();

const rootDiv = document.getElementById("content");

const home = "<h1>Welcome!</h1>";
const contact = "<h1>contact page</h1>";
const pageNotFound = "<h1 class='text-center'>Page Not Found!</h1>";

const routes = {
    "/": home,
    "/404": pageNotFound,
    "/contact": contact,
};

function ajaxCall(method, slug, requestData, headers) {
    console.log(headers);
    const result = $.ajax({
        type: method,
        url: vars.baseApiUrl + slug,
        data: requestData,
        headers: headers,
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

export const onNavigate = (pathname) => {
    async function myDisplay() { 

        var response = await ajaxCall("POST", "login", {
            email: 'admin@admin.com',
            password : 123456
        });

        var article_response = await ajaxCall("POST", "get-article-details-by-id", {
            id: 47,
            },
            {
                 "Authorization": 'Bearer '+response.token
            }
        );

        if (article_response.success === 1) {
            console.log(article_response.success)
            
        } else {
            rootDiv.innerHTML = routes["/404"];
        }

        var articles_response = await ajaxCall("POST", "get-articles", {limit: 3, offset:2},
            {
                "Authorization": 'Bearer '+response.token
            });

        if (articles_response.success === 1) {
            console.log(articles_response.success)
            
        } else {
            rootDiv.innerHTML = routes["/404"];
        }
    }
    myDisplay();
};  

onNavigate(window.location.pathname);
window.onpopstate = () => {
    onNavigate(window.location.pathname);
};
