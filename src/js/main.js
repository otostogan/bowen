window.addEventListener('DOMContentLoaded', ()=>{
    const trigger = document.querySelector('.sorter__load span'), 
          allI = document.querySelector('[data-all]').dataset.all,
          perP = document.querySelector('[data-perpage]').dataset.perpage,
          pageID = document.querySelector('[data-id]').dataset.id,
          dataMax = document.querySelector('[data-max]').dataset.max;

    let page = document.querySelector('[data-page]').dataset.page;

    async function fetch(){
        const url = bowen_ajax.ajax_url;
        const data = {
            action: 'load',
            allI,
            perP,
            page,
            pageID
        };
        if(+page < +dataMax){
            await jQuery.post(url, data, function(response){
                jQuery(function($) {
                    $('.sorter__content').append(response);
                });
                page++;
                document.querySelector('[data-page]').setAttribute('data-page', page);

                if(page == dataMax){
                    trigger.style.display = 'none';
                }
                
            }, "html");
        }
    }    

    trigger.addEventListener('click', ()=>{
        fetch();
    })

    // if(page == dataMax){
    //     trigger.style.display = 'none';
    // }
});