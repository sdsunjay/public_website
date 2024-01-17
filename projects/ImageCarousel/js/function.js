$(document).ready(function() {


    // Create an img element for each image and append it to the image slider
    function nextImage(imageIndex) {
        let images = [{
                "src": "../../images/projects/swslof16/team.jpg",
                "alt": "Startup Weekend SLO Fall 2016"

            },
            {
                "src": "../../images/projects/swslo16/team.jpg",
                "alt": "Startup Weekend SLO 2016"
            },
            {
                "src": "../../images/projects/swsb14/team.jpg",
                "alt": "Startup Weekend Santa Barbara 2014"
            },
            {
                "src": "../../images/projects/swsm14/team.jpg",
                "alt": "Startup Weekend Santa Maria 2014"
            },
            {
                "src": "../../images/projects/swslo14/team.jpg",
                "alt": "Startup Weekend SLO 2014"
            },
            {
                "src": "../../images/projects/laedu14/team.jpg",
                "alt": "Startup Weekend EDU LA 2014"
            },
            {
                "src": "../../images/projects/swslo13/team.jpg",
                "alt": "Startup Weekend SLO 2013"
            }

        ];
        var image = images[imageIndex];
        var img = $('<img>');
        img.attr('src', image.src);
        img.attr('alt', image.alt);
        $("#image1").attr("src", image.src);
        $("#image1").attr("alt", image.alt);

    }

    var current = 0;
    setInterval(function() {
        nextImage(current);
        current++;
        if (current >= 6) {
            current = 0;
        }
    }, 3000);
});