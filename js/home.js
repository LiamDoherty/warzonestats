$(document).ready(function () {
    $('.overlay-type').on('change', function() {
       SetPicture($(this));
      });

      $('.overlay-type').each(function (){
          SetPicture($(this));
      });
});

function SetPicture(overlayType)
{
    var type = overlayType.val();
    if(overlayType.val() == "summary"){
        $('.dailyPreview').hide();
        $('.summaryPreview').show();
    }
    else if(overlayType.val() == "daily"){
        $('.dailyPreview').show();
        $('.summaryPreview').hide();
    }
}
