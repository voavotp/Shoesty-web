$(document).ready(function () {
    var searchbar = $('#search');
    var searchresult = $('#showresult');

    // code for autocomplete
    searchbar.typeahead({
        highlight: true,
        minLength: 3,
    }, {
        name: 'shoes',
        display: 'display',
        source: function (query, syncResults, asyncResults) {
            $.ajax({
                url: '../shoesty/php/search.php?autocomplete=true',
                type: 'GET',
                data: { query: query },
                dataType: 'json',
                success: function (data) {
                    asyncResults(data);
                },
            });
        }
    });

// code for click search button, then showing the shoes after click
$('#searchbutton').on('click', function () {
        const query = searchbar.val();

        if (query.trim() !== '') {
            searchresult.empty(); 

            $.ajax({
                url: '../shoesty/php/search.php',
                type: 'GET',
                data: { query: query },
                dataType: 'json',
                success: function (results) {
                    if (results.length > 0) {
                        results.forEach(function (shoes) {
                            searchresult.append(`
                                <div class="shoebox">
                                    <img src="${shoes.Image}"class="shoebox-image">
                                    <h2>${shoes.Model}</h2>
                                    <p><strong> ${shoes.Name}</strong></p>
                                    <p><strong>Brand:</strong> ${shoes.Brand}</p>
                                    <p><strong>Price:</strong> $${shoes.Price}</p>
                                    <p><strong>Contact:</strong><a href="mailto:${shoes.Email}">${shoes.Email}</a></p>
                                </div>
                            `);
                        });
                    } else {
                        searchresult.append('<p>We dont have this shoe. Sorry!</p>');
                    }
                },
            });
        } else {
            searchresult.empty();
        }
    });
});
