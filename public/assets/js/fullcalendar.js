document.addEventListener('DOMContentLoaded',  function() {
    var calendarEl = document.getElementById('calendar');
    let taches = [];
    fetch('/admin/agenda/fetchOneDayTachesJson')
    .then(res =>  {
        return res.json()
    }).then((taches) => {
        
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid', 'interaction' ],
            editable: true,
            events: taches
    
        });
     
    
        calendar.render();
    
    
    })
 
    
}); 


