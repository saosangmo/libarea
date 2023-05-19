const favicon = queryAll(".add-favicon"),
  screenshot = queryAll(".add-screenshot");

// Write down a Favicon
favicon.forEach(el => el.addEventListener("click", function (e) {
  makeRequest("/web/favicon/add", options = { body: "id=" + el.dataset.id })
}));

// Write down a Screenshot
screenshot.forEach(el => el.addEventListener("click", function (e) {
  makeRequest("/web/screenshot/add", options = { body: "id=" + el.dataset.id })
}));

// search
isIdEmpty('find-url').onclick = function () {
  getById('find-url').addEventListener('keydown', function () {
    fetchSearchUrl();
  });
}

function fetchSearchUrl() {
  let url = getById("find-url").value;
  if (url.length < 5) return;

  fetch("/search/web/url", {
    method: "POST",
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: "url=" + url + "&_token=" + token,
  })
    .then(
      response => {
        return response.text();
      }
    ).then(
      text => {
        let obj = JSON.parse(text);
        let html = '<div class="flex">';
        for (let key in obj) {
           if (obj[key].item_id) {
             html += '<a class="block green text-sm mt5 mb5" href="/web/website/' + obj[key].item_id + '">' + obj[key].item_url + '</a>';
           }  

          html += '</div>';
        }

        if (!Object.keys(obj).length == 0) {
          let items = getById("search_url");
          items.classList.add("block");
          items.innerHTML = html;
        }

        let menu = document.querySelector('.none.block');
        if (menu) {
          document.onclick = function (e) {
            if (event.target.className != '.none.block') {
              let items = getById("search_url");
              items.classList.remove("block");
            };
          };
        }
      }
    );
}