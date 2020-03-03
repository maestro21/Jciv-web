function selectRuleset(sel) {
    if(sel == '-') return;

    if(sel == 'new') {
        name = prompt('Set ruleset name');

        if(name){
            $.post('',{
                name: name,
                do: 'newRuleset'
            })
        }
        sel = name;
    }

    window.location = '?m=rulesets&ruleset=' + sel;
}

function showTab(id) {
    $('.tab').hide();
    $('#' + id).show();
}

function formatState (state) {
    if (!state.id) {
      return state.text;
    }
    var baseUrl = "http://localhost/jciv/flags/src/sml/";
    var $state = $(
      '<span><img src="' + baseUrl + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
    );
    return $state;
};

$(document).ready(function(){
    var anchorHash = window.location.href.toString();
    console.log(anchorHash);
    if( anchorHash.lastIndexOf('#') != -1 ) {
        anchorHash = anchorHash.substr(anchorHash.lastIndexOf('#') + 1);
        console.log(anchorHash);
        showTab(anchorHash);
    }
      
    $(".dd").select2({
        templateResult: formatState,
        templateSelection: formatState
    });
});