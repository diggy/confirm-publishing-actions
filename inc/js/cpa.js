jQuery(document).ready(function($)
{
    $("a.submitdelete").click(function()
    {
        var c = true;
        c = confirm(cpa_l10n_obj.confirm_delete);
        if (!c)
        {
            $("#submitpost .spinner").hide();
            $("input#publish").removeClass("button-primary-disabled");
        }
        return c;
    });
    $("input#publish").click(function()
    {
        var a = $(this).val();
        var c = true;
        
        if (a == cpa_l10n_obj.submit)
        {
            c = confirm(cpa_l10n_obj.confirm_submit);
        }
        if (a == cpa_l10n_obj.publish)
        {
            c = confirm(cpa_l10n_obj.confirm_publish);
        }
        if (a == cpa_l10n_obj.update)
        {
            c = confirm(cpa_l10n_obj.confirm_update);
        }
        if (a == cpa_l10n_obj.schedule)
        {
            c = confirm(cpa_l10n_obj.confirm_schedule);
        }
        if (!c)
        {
            $("#submitpost .spinner").hide();
            $("input#publish").removeClass("button-primary-disabled");
        }
        return c;
    });
});