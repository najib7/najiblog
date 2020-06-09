$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**old */
    // actions posts
    $('.posts').hover(function() {
        $(this).children('.posts-actions').fadeIn();
    }, function() {
        $(this).children('.posts-actions').fadeOut();
    });
    
    /**
     * Global
     */

     // delete button
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault()
        Swal.fire({
            title: `Are you sure?`,
            // text: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                let form = $(this).next()
                if(form.is('form')) {
                    form.submit()
                } else {
                    throw new Error('Failed to delete the item')
                }
            }
        })
    })


    /**
     * dashboard
     */

    // limit lenght of string 
    function limitString(str, lenght) {
        if(str.length > lenght) {
            return str.substring(0, lenght) + '...'
        } else {
            return str
        }
        
    }

    // limit comment lenght in dashboard comment table
    $('.show-comment').each((index, element) => {
        element.innerHTML = limitString(element.innerHTML, 60)
    })


    // elements
    let formModal    = $('#formModal')
    let formCategory = $('#form-category')
    let submitButton = $('#submit-button')

    // create new category
    $('.create-category').click((event) => {
        event.preventDefault()

        submitButton.data('type', 'create')
        submitButton.text('create')

        formModal.modal('show')
        formCategory.trigger('reset')
    })

    // edit category
    $(document).on('click', '.edit-category', function(event) {
        event.preventDefault()

        submitButton.data('type', 'edit')
        submitButton.text('edit')

        formModal.modal('show') // form insid bootsrap model

        let cateogry = $(this).data('category')

        formCategory.trigger('reset')
        formCategory.find('input[name="name"]').val(cateogry.name)
        formCategory.find('textarea[name="description"]').val(cateogry.description)
        submitButton.data('id', cateogry.id) 
    })

    // submit form
    submitButton.click(function(event) {
        event.preventDefault()
        
        let category = formCategory.find('input[name="name"]')
        let description = formCategory.find('textarea[name="description"]')

        let data = {
            'name': category.val(),
            'description': description.val()
        }
        
        // reset validator messages
        $('.validate').remove()

        if($(this).data('type') === 'create') { // create button
            $.ajax({
                url: "/api/categories",
                type: "post",
                data: data,
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'Good job!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                window.location.reload()
                            }
                        })
                    } else if(response.status === 'error'){
                        $.each(response.message, (key, value) => {
                            $(`<span class="text-danger validate">${value[0]}</span>`).insertAfter(formCategory.find(`*[name="${key}"]`))
                        })
                    }
                },
                error: function(error){
                    
                }
            })
        } else if($(this).data('type') === 'edit') { // edit button
            let id = $(this).data('id')
            $.ajax({
                url: `/api/categories/${id}`,
                type: "put",
                data: data,
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'Good job!',
                            text: response.message,
                            icon: 'info',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                window.location.reload()
                            }
                        })
                    } else if(response.status === 'error'){
                        $.each(response.message, (key, value) => {
                            $(`<span class="text-danger validate">${value[0]}</span>`).insertAfter(formCategory.find(`*[name="${key}"]`))
                        })
                    }
                },
                error: function(error){
                    
                }
            })
        }
    })


    // delete request
    $(document).on('click', '.delete-category', function(event) {
        event.preventDefault()
        let category = $(this).data('category')
        Swal.fire({
            title: `Delete '${category.name}' category.`,
            text: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: `/api/categories/${category.id}`,
                    type: "DELETE",
                    success: function(response) {
                        if(response.status === 'success') {
                            Swal.fire('Deleted!', response.message, 'success').then((result) => {
                                if(result.value) {
                                    window.location.reload()
                                }
                            })
                        } else if(response.status === 'error') {
                            Swal.fire('Error!', response.message, 'warning')
                        }
                    }
                })
            }
        })
    })

    let formComment = $('#form-comment')

    // edit comment
    $('.edit-comment').click(function(event) {
        let comment = $(this).data('comment') // get the comment
        formComment.find('*[name="comment"]').val(comment.comment)
        $('#submit-comment').data('comment', comment)
    })

    $('#submit-comment').click(function(event) { // edit comment
        $('.validate').remove()
        let comment = $(this).data('comment')
        let data = {
            'comment': formComment.find('*[name="comment"]').val()
        }
        $.ajax({
            url: `/api/comments/${comment.id}`,
            type: "PUT",
            data: data,
            success: function(response) {
                if(response.status === 'success') {
                    Swal.fire({
                        title: 'Good job!',
                        text: response.message,
                        icon: 'info',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            window.location.reload()
                        }
                    })
                } else if(response.status === 'error') {
                    $(`<span class="text-danger validate">${response.message.comment[0]}</span>`).insertAfter(formComment.find(`*[name="comment"]`))
                }
            }
        })
    })
    



    /**
     * blog
     */

    //logout button
    $('#logout-button').click((e) => {
        e.preventDefault()
        $('#logout-form').submit()
    })


    //image preview
    $('#image').change((e) => {
        if(FileReader) {
            let fr = new FileReader()
            fr.onload = function() {
                $('#out-image').attr('src', fr.result)
            }
            fr.readAsDataURL(e.target.files[0]);
        }
    })
    

    /**
     * 
     * profile
     */

    // badge background color
    let roleBadge = $('.role-badge')
    switch (roleBadge.text()) {
        case 'admin':
            roleBadge.addClass('badge-danger')
            break;
        case 'author':
            roleBadge.addClass('badge-secondary')
            break;
        case 'standard':
            roleBadge.addClass('badge-info')
            break;
        default:
            roleBadge.addClass('badge-dark')
            break;
    }
    
    
    // $('.show-comment').each((index, element) => {
    //     element.innerHTML = limitString(element.innerHTML, 60)
    // })
})


