var CkEditorImageBrowser={folders:[],images:{},ckFunctionNum:null,$folderSwitcher:null,$imagesContainer:null,init:function(){CkEditorImageBrowser.$folderSwitcher=$("#js-folder-switcher"),CkEditorImageBrowser.$imagesContainer=$("#js-images-container");var e=CkEditorImageBrowser.getQueryStringParam("baseHref");if(e){var r=document.head||document.getElementsByTagName("head")[0];r.getElementsByTagName("link")[0].href=location.href.replace(/\/[^\/]*$/,"/browser.css"),r.getElementsByTagName("base")[0].href=e}CkEditorImageBrowser.ckFunctionNum=CkEditorImageBrowser.getQueryStringParam("CKEditorFuncNum"),CkEditorImageBrowser.initEventHandlers(),CkEditorImageBrowser.loadData(CkEditorImageBrowser.getQueryStringParam("listUrl"),(function(){CkEditorImageBrowser.initFolderSwitcher()}))},loadData:function(e,r){CkEditorImageBrowser.folders=[],CkEditorImageBrowser.images={},$.getJSON(e,(function(e){$.each(e,(function(e,r){void 0===r.folder&&(r.folder="Images"),void 0===r.thumb&&(r.thumb=r.image),CkEditorImageBrowser.addImage(r.folder,r.image,r.thumb)})),r()})).error((function(r,o,t){var a;a=r.status<200||r.status>=400?"HTTP Status: "+r.status+"/"+r.statusText+': "<strong style="color: red;">'+e+'</strong>"':"parsererror"===o?o+': invalid JSON file: "<strong style="color: red;">'+e+'</strong>": '+t.message:o+" / "+r.statusText+" / "+t.message,CkEditorImageBrowser.$imagesContainer.html(a)}))},addImage:function(e,r,o){void 0===CkEditorImageBrowser.images[e]&&(CkEditorImageBrowser.folders.push(e),CkEditorImageBrowser.images[e]=[]),CkEditorImageBrowser.images[e].push({imageUrl:r,thumbUrl:o})},initFolderSwitcher:function(){var e=CkEditorImageBrowser.$folderSwitcher;e.find("li").remove(),$.each(CkEditorImageBrowser.folders,(function(r,o){$("<li></li>").data("idx",r).text(o).appendTo(e)})),0===CkEditorImageBrowser.folders.length?(e.remove(),CkEditorImageBrowser.$imagesContainer.text("No images.")):(1===CkEditorImageBrowser.folders.length&&e.hide(),e.find("li:first").click())},renderImagesForFolder:function(e){var r=CkEditorImageBrowser.images[e],o=$("#js-template-image").html();CkEditorImageBrowser.$imagesContainer.html(""),$.each(r,(function(e,r){var t=o;t=(t=t.replace("%imageUrl%",r.imageUrl)).replace("%thumbUrl%",r.thumbUrl);var a=$($.parseHTML(t));CkEditorImageBrowser.$imagesContainer.append(a)}))},initEventHandlers:function(){$(document).on("click","#js-folder-switcher li",(function(){var e=parseInt($(this).data("idx"),10),r=CkEditorImageBrowser.folders[e];$(this).siblings("li").removeClass("active"),$(this).addClass("active"),CkEditorImageBrowser.renderImagesForFolder(r)})),$(document).on("click",".js-image-link",(function(){window.opener.CKEDITOR.tools.callFunction(CkEditorImageBrowser.ckFunctionNum,$(this).data("url")),window.close()}))},getQueryStringParam:function(e){var r=new RegExp("[?&]"+e+"=([^&]*)"),o=window.location.search.match(r);return o&&o.length>1?decodeURIComponent(o[1]):null}};