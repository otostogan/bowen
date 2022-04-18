window.addEventListener('DOMContentLoaded', ()=>{
    
   
    const trigger = document.querySelector('.sorter__load span'), 
        allI = document.querySelector('[data-all]').dataset.all,
        perP = document.querySelector('[data-perpage]').dataset.perpage,
        pageID = document.querySelector('[data-id]').dataset.id,
        dataMax = document.querySelector('[data-max]').dataset.max, 
        drop = document.querySelector('.sorter__filter-drop');

    let page = document.querySelector('[data-page]').dataset.page;


    drop.addEventListener('click', ()=>{
        document.querySelector('.sorter__filter-list').classList.toggle('active');
    })
    trigger.addEventListener('click', ()=>{
        fetch();
    })
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

                const toReload = document.querySelector('#oba_youtubepopup_activate-js').src;
                document.querySelector('#oba_youtubepopup_activate-js').remove();

                setTimeout(()=>{
                    reloadScript(toReload, 'oba_youtubepopup_activate-js');
                }, 300)
                
            }, "html");
        }
    }    
    function reloadScript(url, id) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = url;
        script.id = id
        document.body.appendChild(script);
    }    
});