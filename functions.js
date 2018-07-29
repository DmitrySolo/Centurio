/**
 * Created by disol on 19.07.2018.
 */
var quantServerCommand = function(triggerStr,actionType,argsObj,getDataCallback,callback,method){

    if(!getDataCallback) var getDataCallback = false;
    if(!method) var method ='GET';


    $(triggerStr).on(actionType,function(e){
           console.log(this);
           var _this = this;
            console.log(_this);
            if(typeof getDataCallback ==='function') argsObj.data =	getDataCallback(e,this);

            var url = '/Centurio/ajax.php';
            console.log(argsObj);
            $.ajax({
                url: url
                , type: method
                , data: argsObj
                , success: function (res) {
                    if(typeof callback === 'function') callback(res);
                }
            });
        }
    )

}
var qntGetThisData = function (_this,concretData) {



    if( concretData && _this.dataset.hasOwnProperty(concretData)) {  return _this.dataset[concretData] };
    // return _this.dataset
}
//END

quantServerCommand($('.resultList__item'),'click',{},
    function(e,_this){console.log(qntGetThisData(_this,'data_brand_id'))},
    function(res){
        console.log(res);
    }
    );