function getHtmlOfErrorsReturnedFromServer(response)
{
    var html='';

    if(typeof response.errors!='undefined')
    {
        html+=''+
            '<div>';
        if(response.errors.constructor === Array || response.errors.constructor === Object)
        {
            for (var i in response.errors)
            {
                if (response.errors.hasOwnProperty(i)) {
                    for (var j in response.errors[i]) {
                        if (response.errors[i].hasOwnProperty(j)) {
                            html += '<div>' + response.errors[i][j] + '</div>';
                        }
                    }
                }
            }
        }
        else
        {
            html += '<div>' + response.errors + '</div>';
        }
        html+=''+
            '</div>';
    }
    else if(typeof response.error!='undefined')
    {
        html += '<div>' + response.error + '</div>';
    }

    html+=''+
        '</div>';

    return html;

}


function getAlertBoxHtmlContainingErrorsReturnedFromServer(response)
{

    var html='';

    html+=''+
        '<div class="alert alert-danger">'+
        '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>';

    html+=''+getHtmlOfErrorsReturnedFromServer(response);

    html+=''+
        '</div>';

    return html;

}