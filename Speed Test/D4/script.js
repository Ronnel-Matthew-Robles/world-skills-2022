const jsonFile = "data.json";
const itemsPerPage = 10;
let page = 1;
let isLoading = false;

function loadData() {
  if (isLoading) {
    return;
  }
  isLoading = true;
  $("#loading").show();
  $.ajax({
    url: jsonFile,
    dataType: "json",
    data: {
      limit: itemsPerPage,
      page: page,
    },
    success: function (data) {
      if (data.length > 0) {
        const html = data
          .map(function (item) {
            return `
            <div class="item">
              <h2>${item.first_name} ${item.last_name}</h2>
              <p>Email: ${item.email}</p>
              <p>Country: ${item.country}</p>
              <p>City: ${item.city}</p>
              <p>Phone: ${item.phone}</p>
            </div>
          `;
          })
          .join("");
        $("#content").append(html);
        isLoading = false;
        $("#loading").hide();
        page++;
      } else {
        $("#loading").html("No more results");
      }
    },
    error: function (xhr, status, error) {
      console.error(status, error);
      $("#loading").html("Error loading data");
    },
  });
}

$(window).scroll(function () {
  const windowHeight = $(window).height();
  const scrollTop = $(window).scrollTop();
  const documentHeight = $(document).height();
  if (documentHeight - (windowHeight + scrollTop) < 50) {
    loadData();
  }
});

loadData();
