jQuery(document).ready(function()
{
    jQuery("a.submitdelete").click(function()
    {
        var c = true;
        c = confirm(cpa_l10n_obj.confirm_delete);
        if (!c)
        {
            jQuery("#submitpost .spinner").hide();
            jQuery("input#publish").removeClass("button-primary-disabled");
        }
        return c;
    });
    jQuery("input#publish").click(function()
    {
        var a = jQuery(this).val();
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
        if (!c)
        {
            jQuery("#submitpost .spinner").hide();
            jQuery("input#publish").removeClass("button-primary-disabled");
        }
        return c;
    });
});