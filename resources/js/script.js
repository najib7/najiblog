$(function() {
    // manag post buttons
    $('.post-outer').hover(function() {
        $(this).children('.manag-post').show();
    }, function() {
        $(this).children('.manag-post').hide();
    });

    // btn comments
    $('.comment-post .comment').hover(function() {
        $(this).children('.btn-comment').show();
    }, function() {
        $(this).children('.btn-comment').hide();
    });

    // delete records in datatable
    $('#dataTable').on('click', '.btn-delete', function(e) {
        e.preventDefault()
        if(confirm('Are you sure ?!')) {
            e.target.parentElement.nextElementSibling.submit()
        }
    })

    // limit lenght of string
    function limitString(str, lenght) {
        if(str.length > lenght) {
            return str.substring(0, lenght) + '...'
        } else {
            return str
        }
        
    }

    $('.show-comment').each((index, element) => {
        element.innerHTML = limitString(element.innerHTML, 60)
    })
})


