$("#branches").change(function(){
    change();    
});

function change() {        
    var selectValue = $("#branches").val();            
    $("#workers").empty();

    $.post( "'.Yii::$app->urlManager->createUrl('constructor/lists?id=').'"+selectValue,
            function(data){
                $("#workers").html(data);
            }
        );

};   