$(document).ready(function () {
    $('.overlay-type').on('change', function() {
        if(this.value == "summary"){
            $('.dailyPreview').hide();
            $('.summaryPreview').show();
        }
        else if(this.value = "daily"){
            $('.dailyPreview').show();
            $('.summaryPreview').hide();
        }
      });
});
