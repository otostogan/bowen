jQuery(function($) {
    const first_floor_elem = $('.first__floor  li'),
    second_floor_elem = $('.first__floor  li  ul  li'),
    column_menu = $('.first__floor  li  ul  li  ul  li'),
    third_floor_elem = $('.first__floor  li  ul  li  ul  li  ul  li');
    
    if(first_floor_elem.length) {
        first_floor_elem.each(function () {
            $(this).addClass('first__floor--item');
            $(this).parent().addClass('visible');
            if($(this).hasClass('simple-menu') == false && $(this).hasClass('mega-menu') == false) {
                $(this).addClass('simple-menu');
            }

        });
    }

    if(second_floor_elem.length) {
        second_floor_elem.each(function () {
            $(this).addClass('second__floor--item');
            $(this).parent().addClass('second__floor');
        });
    }
    if(third_floor_elem.length) {
        third_floor_elem.each(function () {
            $(this).addClass('third__floor--item');
            $(this).parent().addClass('third__floor');
        });
    }
    if(column_menu.length) {
        column_menu.each(function () {
            $(this).addClass('column__menu--item');
            $(this).parent().addClass('column__menu');
            $(this).find(' > a').remove();
        });
    }

    const burger_elem_first = $('.burger-menu__first  li'),
        burger_elem_second = $('.burger-menu__first  li  ul  li'),
        burger_column = $('.burger-menu__first  li  ul  li  ul  li'),
        burger_elem_third = $('.burger-menu__first  li  ul  li  ul  li  ul  li');
   
    if(burger_elem_first.length) {
        burger_elem_first.each(function () {
            $(this).addClass('burger-menu__first--item');
            $(this).parent().addClass('visible');
        });
    }

    if(burger_elem_second.length) {
        burger_elem_second.each(function () {
            $(this).addClass('burger-menu__second--item');
            $(this).parent().addClass('burger-menu__second');
        });
    }
    if(burger_elem_third.length) {
        burger_elem_third.each(function () {
            $(this).addClass('burger-menu__third--item');
            $(this).parent().addClass('burger-menu__third');
            if ($(this).hasClass('menu-item-has-children')) {
                $(this).addClass('has-child').children('a').after('<span class="icon"><i class="fa fa-plus" aria-hidden="true"></i></span>');
            }
        });
        burger_elem_third.find('.icon').on('click', function () {
            $(this).next().slideToggle();
            $(this).children().hasClass('fa-plus') ?
                $(this).children().removeClass('fa-plus').addClass('fa-minus') :
                $(this).children().addClass('fa-plus').removeClass('fa-minus');
        });
    }
    if(burger_column.length) {
        burger_column.each(function () {
            $(this).addClass('column__menu--item');
            $(this).parent().addClass('column__menu');
            $(this).find(' > a').remove();
        });
    }

   
  
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > 1 ) {
            $('.header').addClass('fixed');
        } else {
            $('.header').removeClass('fixed');
        }

        
    });
   
})