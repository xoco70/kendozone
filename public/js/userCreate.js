/*!
* @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
* @version 2.6.0
* bootstrap-fileinput
* For more JQuery Plugins visit http://plugins.krajee.com
*/!function(e){var i='style="width:{width};height:{height};"',t='   <div class="text-center"><small>{caption}</small></div>\n',n='      <param name="controller" value="true" />\n      <param name="allowFullScreen" value="true" />\n      <param name="allowScriptAccess" value="always" />\n      <param name="autoPlay" value="false" />\n      <param name="autoStart" value="false" />\n      <param name="quality" value="high" />\n',a='<div class="file-preview-other" '+i+'>\n       <h2><i class="glyphicon glyphicon-file"></i></h2>\n   </div>',r={main1:'{preview}\n<div class="input-group {class}">\n   {caption}\n   <div class="input-group-btn">\n       {remove}\n       {upload}\n       {browse}\n   </div>\n</div>',main2:"{preview}\n{remove}\n{upload}\n{browse}\n",preview:'<div class="file-preview {class}">\n   <div class="close fileinput-remove text-right">&times;</div>\n   <div class="file-preview-thumbnails"></div>\n   <div class="clearfix"></div>   <div class="file-preview-status text-center text-success"></div>\n   <div class="kv-fileinput-error"></div>\n</div>',caption:'<div tabindex="-1" class="form-control file-caption {class}">\n   <span class="glyphicon glyphicon-file kv-caption-icon"></span><div class="file-caption-name"></div>\n</div>',modal:'<div id="{id}" class="modal fade">\n  <div class="modal-dialog modal-lg">\n    <div class="modal-content">\n      <div class="modal-header">\n        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\n        <h3 class="modal-title">Detailed Preview <small>{title}</small></h3>\n      </div>\n      <div class="modal-body">\n        <textarea class="form-control" style="font-family:Monaco,Consolas,monospace; height: {height}px;" readonly>{body}</textarea>\n      </div>\n    </div>\n  </div>\n</div>\n'},l=["image","html","text","video","audio","flash","object"],o={generic:'<div class="file-preview-frame" id="{previewId}">\n   {content}\n</div>\n',html:'<div class="file-preview-frame" id="{previewId}">\n    <object data="{data}" type="{type}" width="{width}" height="{height}">\n       '+a+"\n    </object>\n"+t+"</div>",image:'<div class="file-preview-frame" id="{previewId}">\n   <img src="{data}" class="file-preview-image" title="{caption}" alt="{caption}" '+i+">\n</div>\n",text:'<div class="file-preview-frame" id="{previewId}">\n   <div class="file-preview-text" title="{caption}" '+i+">\n       {data}\n   </div>\n</div>\n",video:'<div class="file-preview-frame" id="{previewId}" title="{caption}" '+i+'>\n   <video width="{width}" height="{height}" controls>\n       <source src="{data}" type="{type}">\n       '+a+"\n   </video>\n"+t+"</div>\n",audio:'<div class="file-preview-frame" id="{previewId}" title="{caption}" '+i+'>\n   <audio controls>\n       <source src="{data}" type="{type}">\n       '+a+"\n   </audio>\n"+t+"</div>\n",flash:'<div class="file-preview-frame" id="{previewId}" title="{caption}" '+i+'>\n   <object type="application/x-shockwave-flash" width="{width}" height="{height}" data="{data}">\n'+n+"       "+a+"\n   </object>\n"+t+"</div>\n",object:'<div class="file-preview-frame" id="{previewId}" title="{caption}" '+i+'>\n    <object data="{data}" type="{type}" width="{width}" height="{height}">\n      <param name="movie" value="{caption}" />\n'+n+"           "+a+"\n   </object>\n"+t+"</div>",other:'<div class="file-preview-frame" id="{previewId}" title="{caption}" '+i+">\n   "+a+"\n"+t+"</div>"},s={image:{width:"auto",height:"160px"},html:{width:"320px",height:"180px"},text:{width:"160px",height:"160px"},video:{width:"320px",height:"240px"},audio:{width:"320px",height:"80px"},flash:{width:"320px",height:"240px"},object:{width:"320px",height:"100%"},other:{width:"160px",height:"120px"}},p={image:function(e,i){return"undefined"!=typeof e?e.match("image.*"):i.match(/\.(gif|png|jpe?g)$/i)},html:function(e,i){return"undefined"!=typeof e?"text/html"==e:i.match(/\.(htm|html)$/i)},text:function(e,i){return"undefined"!=typeof e&&e.match("text.*")||i.match(/\.(txt|md|csv|nfo|php|ini)$/i)},video:function(e,i){return"undefined"!=typeof e&&e.match(/\.video\/(ogg|mp4|webm)$/i)||i.match(/\.(og?|mp4|webm)$/i)},audio:function(e,i){return"undefined"!=typeof e&&e.match(/\.audio\/(ogg|mp3|wav)$/i)||i.match(/\.(ogg|mp3|wav)$/i)},flash:function(e,i){return"undefined"!=typeof e&&"application/x-shockwave-flash"==e||i.match(/\.(swf)$/i)},object:function(){return!0},other:function(){return!0}},d=function(i,t){return null===i||void 0===i||i==[]||""===i||t&&""===e.trim(i)},c=function(e){return Array.isArray(e)||"[object Array]"===Object.prototype.toString.call(e)},v=function(e,i){return"object"==typeof i&&e in i},m=function(i,t,n){return d(i)||d(i[t])?n:e(i[t])},g=function(){return Math.round((new Date).getTime()+100*Math.random())},u=function(){return window.File&&window.FileReader&&window.FileList&&window.Blob},w=function(e){return String(e).replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/</g,"&lt;").replace(/>/g,"&gt;")},f=window.URL||window.webkitURL,h=function(i,t){this.$element=e(i),u()?(this.init(t),this.listen()):this.$element.removeClass("file-loading")};h.prototype={constructor:h,init:function(e){var i=this;i.reader=null,i.showCaption=e.showCaption,i.showPreview=e.showPreview,i.maxFileSize=e.maxFileSize,i.maxFileCount=e.maxFileCount,i.msgSizeTooLarge=e.msgSizeTooLarge,i.msgFilesTooMany=e.msgFilesTooMany,i.msgFileNotFound=e.msgFileNotFound,i.msgFileNotReadable=e.msgFileNotReadable,i.msgFilePreviewAborted=e.msgFilePreviewAborted,i.msgFilePreviewError=e.msgFilePreviewError,i.msgValidationError=e.msgValidationError,i.msgErrorClass=e.msgErrorClass,i.initialDelimiter=e.initialDelimiter,i.initialPreview=e.initialPreview,i.initialCaption=e.initialCaption,i.initialPreviewCount=e.initialPreviewCount,i.initialPreviewContent=e.initialPreviewContent,i.overwriteInitial=e.overwriteInitial,i.layoutTemplates=e.layoutTemplates,i.previewTemplates=e.previewTemplates,i.allowedPreviewTypes=d(e.allowedPreviewTypes)?l:e.allowedPreviewTypes,i.allowedPreviewMimeTypes=e.allowedPreviewMimeTypes,i.allowedFileTypes=e.allowedFileTypes,i.allowedFileExtensions=e.allowedFileExtensions,i.previewSettings=e.previewSettings,i.fileTypeSettings=e.fileTypeSettings,i.showRemove=e.showRemove,i.showUpload=e.showUpload,i.captionClass=e.captionClass,i.previewClass=e.previewClass,i.mainClass=e.mainClass,i.mainTemplate=i.getLayoutTemplate(i.showCaption?"main1":"main2"),i.captionTemplate=i.getLayoutTemplate("caption"),i.previewGenericTemplate=i.getPreviewTemplate("generic"),i.browseLabel=e.browseLabel,i.browseIcon=e.browseIcon,i.browseClass=e.browseClass,i.removeLabel=e.removeLabel,i.removeIcon=e.removeIcon,i.removeClass=e.removeClass,i.uploadLabel=e.uploadLabel,i.uploadIcon=e.uploadIcon,i.uploadClass=e.uploadClass,i.uploadUrl=e.uploadUrl,i.msgLoading=e.msgLoading,i.msgProgress=e.msgProgress,i.msgSelected=e.msgSelected,i.msgInvalidFileType=e.msgInvalidFileType,i.msgInvalidFileExtension=e.msgInvalidFileExtension,i.previewFileType=e.previewFileType,i.wrapTextLength=e.wrapTextLength,i.wrapIndicator=e.wrapIndicator,i.isError=!1,i.isDisabled=i.$element.attr("disabled")||i.$element.attr("readonly"),d(i.$element.attr("id"))&&i.$element.attr("id",g()),"undefined"==typeof i.$container?i.$container=i.createContainer():i.refreshContainer(),i.$captionContainer=m(e,"elCaptionContainer",i.$container.find(".file-caption")),i.$caption=m(e,"elCaptionText",i.$container.find(".file-caption-name")),i.$previewContainer=m(e,"elPreviewContainer",i.$container.find(".file-preview")),i.$preview=m(e,"elPreviewImage",i.$container.find(".file-preview-thumbnails")),i.$previewStatus=m(e,"elPreviewStatus",i.$container.find(".file-preview-status")),i.$errorContainer=m(e,"elErrorContainer",i.$previewContainer.find(".kv-fileinput-error")),d(i.msgErrorClass)||i.$errorContainer.removeClass(i.msgErrorClass).addClass(i.msgErrorClass),i.$errorContainer.hide();var t=i.initialPreview;i.initialPreviewCount=c(t)?t.length:t.length>0?t.split(i.initialDelimiter).length:0,i.initPreview(),i.original={preview:i.$preview.html(),caption:i.$caption.html()},i.options=e,i.$element.removeClass("file-loading")},getLayoutTemplate:function(e){var i=this;return v(e,i.layoutTemplates)?i.layoutTemplates[e]:r[e]},getPreviewTemplate:function(e){var i=this;return v(e,i.previewTemplates)?i.previewTemplates[e]:o[e]},listen:function(){var i=this,t=i.$element,n=i.$captionContainer,a=i.$btnFile;t.on("change",e.proxy(i.change,i)),a.on("click",function(){i.clear(!1),n.focus()}),t.closest("form").on("reset",e.proxy(i.reset,i)),i.$container.on("click",".fileinput-remove:not([disabled])",e.proxy(i.clear,i))},refresh:function(i){var t=this,n=arguments.length?e.extend(t.options,i):t.options;t.init(n)},initPreview:function(){var i=this,t="",n=i.initialPreview,a=i.initialPreviewCount,r=i.initialCaption.length,l="preview-"+g(),o=r>0?i.initialCaption:i.msgSelected.replace(/\{n\}/g,a),s=e(o).text();if(c(n)&&a>0){for(var p=0;a>p;p++)l+="-"+p,t+=i.previewGenericTemplate.replace(/\{previewId\}/g,l).replace(/\{content\}/g,n[p]);a>1&&0==r&&(o=i.msgSelected.replace(/\{n\}/g,a))}else{if(!(a>0))return r>0?(i.$caption.html(o),void i.$captionContainer.attr("title",s)):void 0;for(var d=n.split(i.initialDelimiter),p=0;a>p;p++)l+="-"+p,t+=i.previewGenericTemplate.replace(/\{previewId\}/g,l).replace(/\{content\}/g,d[p]);a>1&&0==r&&(o=i.msgSelected.replace(/\{n\}/g,a))}i.initialPreviewContent=t,i.$preview.html(t),i.$caption.html(o),i.$captionContainer.attr("title",s),i.$container.removeClass("file-input-new")},clearObjects:function(){var i=this,t=i.$preview;t.find("video audio").each(function(){this.pause(),delete this,e(this).remove()}),t.find("img object div").each(function(){delete this,e(this).remove()})},clearFileInput:function(){var e=this,i=e.$element;/MSIE/.test(navigator.userAgent)?(i.wrap("<form>").closest("form").trigger("reset"),i.unwrap()):i.val("")},clear:function(){var e=this,i=arguments.length&&arguments[0];if(i&&i.preventDefault(),e.reader instanceof FileReader&&e.reader.abort(),e.clearFileInput(),e.resetErrors(!0),i!==!1&&(e.$element.trigger("change"),e.$element.trigger("fileclear")),e.overwriteInitial&&(e.initialPreviewCount=0),e.overwriteInitial||d(e.initialPreviewContent)){e.clearObjects(),e.$preview.html("");var t=!e.overwriteInitial&&e.initialCaption.length>0?e.original.caption:"";e.$caption.html(t),e.$captionContainer.attr("title",""),e.$container.removeClass("file-input-new").addClass("file-input-new")}else e.showFileIcon(),e.$preview.html(e.original.preview),e.$caption.html(e.original.caption),e.$container.removeClass("file-input-new");e.hideFileIcon(),e.$element.trigger("filecleared"),e.$captionContainer.focus()},reset:function(){var e=this;e.clear(!1),e.$preview.html(e.original.preview),e.$caption.html(e.original.caption),e.$container.find(".fileinput-filename").text(""),e.$element.trigger("filereset"),e.initialPreview.length>0&&e.$container.removeClass("file-input-new")},disable:function(){var e=this;e.isDisabled=!0,e.$element.attr("disabled","disabled"),e.$container.find(".kv-fileinput-caption").addClass("file-caption-disabled"),e.$container.find(".btn-file, .fileinput-remove, .kv-fileinput-upload").attr("disabled",!0)},enable:function(){var e=this;e.isDisabled=!1,e.$element.removeAttr("disabled"),e.$container.find(".kv-fileinput-caption").removeClass("file-caption-disabled"),e.$container.find(".btn-file, .fileinput-remove, .kv-fileinput-upload").removeAttr("disabled")},hideFileIcon:function(){this.overwriteInitial&&this.$captionContainer.find(".kv-caption-icon").hide()},showFileIcon:function(){this.$captionContainer.find(".kv-caption-icon").show()},resetErrors:function(e){var i=this,t=i.$errorContainer;i.isError=!1,i.$container.removeClass("has-error"),e?t.fadeOut("slow"):t.hide()},showError:function(e,i,t,n){var a=this,r=a.$errorContainer,l=a.$element;return r.html(e),r.fadeIn(800),l.trigger("fileerror",[i,t,n]),a.clearFileInput(),a.$container.removeClass("has-error").addClass("has-error"),!0},errorHandler:function(e,i){var t=this;switch(e.target.error.code){case e.target.error.NOT_FOUND_ERR:t.addError(t.msgFileNotFound.replace(/\{name\}/g,i));break;case e.target.error.NOT_READABLE_ERR:t.addError(t.msgFileNotReadable.replace(/\{name\}/g,i));break;case e.target.error.ABORT_ERR:t.addError(t.msgFilePreviewAborted.replace(/\{name\}/g,i));break;default:t.addError(t.msgFilePreviewError.replace(/\{name\}/g,i))}},parseFileType:function(e){for(var i,t,n=0;n<l.length;n++)if(cat=l[n],i=v(cat,self.fileTypeSettings)?self.fileTypeSettings[cat]:p[cat],t=i(e.type,e.name)?cat:"",""!=t)return t;return"other"},previewDefault:function(i,t){var n=this,a=f.createObjectURL(i),r=e("#"+t),l=v("other",n.previewTemplates)?n.previewTemplates.other:o.other;n.$preview.append("\n"+l.replace(/\{previewId\}/g,t).replace(/\{caption\}/g,n.slug(i.name)).replace(/\{type\}/g,i.type).replace(/\{data\}/g,a)),r.on("load",function(){f.revokeObjectURL(r.attr("data"))})},previewFile:function(e,i,t,n){var n,a,r=this,l=r.parseFileType(e),p=r.slug(e.name),c=r.allowedPreviewTypes,m=r.allowedPreviewMimeTypes,u=(e.type,v(l,r.previewTemplates)?r.previewTemplates[l]:o[l]),h=v(l,r.previewSettings)?r.previewSettings[l]:s[l],b=parseInt(r.wrapTextLength),y=r.wrapIndicator,C=r.$preview,$=c.indexOf(l)>=0,x=d(m)||!d(m)&&v(e.type,m);if($&&x){if("text"==l){var F=w(i.target.result);if(f.revokeObjectURL(n),F.length>b){var T="text-"+g(),I=.75*window.innerHeight,P=r.getLayoutTemplate("modal").replace(/\{id\}/g,T).replace(/\{title\}/g,p).replace(/\{height\}/g,I).replace(/\{body\}/g,F);y=y.replace(/\{title\}/g,p).replace(/\{dialog\}/g,"$('#"+T+"').modal('show')"),F=F.substring(0,b-1)+y}a=u.replace(/\{previewId\}/g,t).replace(/\{caption\}/g,p).replace(/\{type\}/g,e.type).replace(/\{width\}/g,h.width).replace(/\{height\}/g,h.height).replace(/\{data\}/g,F)+P}else a=u.replace(/\{previewId\}/g,t).replace(/\{caption\}/g,p).replace(/\{type\}/g,e.type).replace(/\{data\}/g,n).replace(/\{width\}/g,h.width).replace(/\{height\}/g,h.height);C.append("\n"+a)}else r.previewDefault(e,t)},readFiles:function(e){function i(p){if(p>=w)return l.removeClass("loading"),void o.html("");var v,g,y,C,$,x=u+"-"+p,F=e[p],T=t.slug(F.name),I=(F.size?F.size:0)/1e3,P=f.createObjectURL(F),E=0,L=t.allowedFileTypes,S=d(L)?"":L.join(", "),R=t.allowedFileExtensions,j=d(R)?"":R.join(", "),k=d(R)?"":new RegExp("\\.("+R.join("|")+")$","i");if(I=I.toFixed(2),t.maxFileSize>0&&I>t.maxFileSize)return y=t.msgSizeTooLarge.replace(/\{name\}/g,T).replace(/\{size\}/g,I).replace(/\{maxSize\}/g,t.maxFileSize),void(t.isError=t.showError(y,F,x,p));if(!d(L)&&c(L)){for(g=0;g<L.length;g++)C=L[g],v=h[C],$=void 0!==v&&v(F.type,T),E+=d($)?0:$.length;if(0==E)return y=t.msgInvalidFileType.replace(/\{name\}/g,T).replace(/\{types\}/g,S),void(t.isError=t.showError(y,F,x,p))}return 0!=E||d(R)||!c(R)||d(k)||($=T.match(k),E+=d($)?0:$.length,0!=E)?t.showPreview?void(a.length>0&&"undefined"!=typeof FileReader?(o.html(s.replace(/\{index\}/g,p+1).replace(/\{files\}/g,w)),l.addClass("loading"),r.onerror=function(e){t.errorHandler(e,T)},r.onload=function(e){t.previewFile(F,e,x,P)},r.onloadend=function(){var e=m.replace(/\{index\}/g,p+1).replace(/\{files\}/g,w).replace(/\{percent\}/g,100).replace(/\{name\}/g,T);setTimeout(function(){o.html(e),f.revokeObjectURL(P)},1e3),setTimeout(function(){i(p+1)},1500),n.trigger("fileloaded",[F,x,p])},r.onprogress=function(e){if(e.lengthComputable){var i=parseInt(e.loaded/e.total*100,10),t=m.replace(/\{index\}/g,p+1).replace(/\{files\}/g,w).replace(/\{percent\}/g,i).replace(/\{name\}/g,T);setTimeout(function(){o.html(t)},1e3)}},b(F.type,T)?r.readAsText(F):r.readAsArrayBuffer(F)):(t.previewDefault(F,x),n.trigger("fileloaded",[F,x,p]),setTimeout(i(p+1),1e3))):void setTimeout(i(p+1),1e3):(y=t.msgInvalidFileExtension.replace(/\{name\}/g,T).replace(/\{extensions\}/g,j),void(t.isError=t.showError(y,F,x,p)))}this.reader=new FileReader;var t=this,n=t.$element,a=t.$preview,r=t.reader,l=t.$previewContainer,o=t.$previewStatus,s=t.msgLoading,m=t.msgProgress,u=(t.msgSelected,t.previewFileType,parseInt(t.wrapTextLength),t.wrapIndicator,"preview-"+g()),w=e.length,h=t.fileTypeSettings,b=v("text",h)?h.text:p.text;i(0)},slug:function(e){return d(e)?"":e.split(/(\\|\/)/g).pop().replace(/[^\w-.\\\/ ]+/g,"")},change:function(i){var t,n=this,a=n.$element,r=n.slug(a.val()),l=0,o=n.$preview,s=a.get(0).files,p=n.msgSelected,c=d(s)?1:s.length+n.initialPreviewCount;if(n.hideFileIcon(),t=void 0===i.target.files?i.target&&i.target.value?[{name:i.target.value.replace(/^.+\\/,"")}]:[]:i.target.files,0!==t.length){n.resetErrors(),o.html(""),n.overwriteInitial||o.html(n.initialPreviewContent);var l=t.length;if(n.maxFileCount>0&&l>n.maxFileCount){var v=n.msgFilesTooMany.replace(/\{m\}/g,n.maxFileCount).replace(/\{n\}/g,l);return n.isError=n.showError(v,null,null,null),n.$captionContainer.find(".kv-caption-icon").hide(),n.$caption.html(n.msgValidationError),void n.$container.removeClass("file-input-new")}n.readFiles(s),n.reader=null;var m=c>1?p.replace(/\{n\}/g,c):r;n.isError?(n.$captionContainer.find(".kv-caption-icon").hide(),m=n.msgValidationError):n.showFileIcon(),n.$caption.html(m),n.$captionContainer.attr("title",e(m).text()),n.$container.removeClass("file-input-new"),a.trigger("fileselect",[c,r])}},initBrowse:function(e){var i=this;i.$btnFile=e.find(".btn-file"),i.$btnFile.append(i.$element)},createContainer:function(){var i=this,t=e(document.createElement("span")).attr({"class":"file-input file-input-new"}).html(i.renderMain());return i.$element.before(t),i.initBrowse(t),t},refreshContainer:function(){var e=this,i=e.$container;i.before(e.$element),i.html(e.renderMain()),e.initBrowse(i)},renderMain:function(){var e=this,i=e.showPreview?e.getLayoutTemplate("preview").replace(/\{class\}/g,e.previewClass):"",t=e.isDisabled?e.captionClass+" file-caption-disabled":e.captionClass,n=e.captionTemplate.replace(/\{class\}/g,t+" kv-fileinput-caption");return e.mainTemplate.replace(/\{class\}/g,e.mainClass).replace(/\{preview\}/g,i).replace(/\{caption\}/g,n).replace(/\{upload\}/g,e.renderUpload()).replace(/\{remove\}/g,e.renderRemove()).replace(/\{browse\}/g,e.renderBrowse())},renderBrowse:function(){var e=this,i=e.browseClass+" btn-file",t="";return e.isDisabled&&(t=" disabled "),'<div class="'+i+'"'+t+"> "+e.browseIcon+e.browseLabel+" </div>"},renderRemove:function(){var e=this,i=e.removeClass+" fileinput-remove fileinput-remove-button",t="";return e.showRemove?(e.isDisabled&&(t=" disabled "),'<button type="button" class="'+i+'"'+t+">"+e.removeIcon+e.removeLabel+"</button>"):""},renderUpload:function(){var e=this,i=e.uploadClass+" kv-fileinput-upload",t="",n="";return e.showUpload?(e.isDisabled&&(n=" disabled "),t=d(e.uploadUrl)?'<button type="submit" class="'+i+'"'+n+">"+e.uploadIcon+e.uploadLabel+"</button>":'<a href="'+e.uploadUrl+'" class="'+e.uploadClass+'"'+n+">"+e.uploadIcon+e.uploadLabel+"</a>"):""}},e.fn.fileinput=function(i){if(u()){var t=Array.apply(null,arguments);return t.shift(),this.each(function(){var n=e(this),a=n.data("fileinput"),r="object"==typeof i&&i;a||n.data("fileinput",a=new h(this,e.extend({},e.fn.fileinput.defaults,r,e(this).data()))),"string"==typeof i&&a[i].apply(a,t)})}},e.fn.fileinput.defaults={showCaption:!0,showPreview:!0,showRemove:!0,showUpload:!0,mainClass:"",previewClass:"",captionClass:"",mainTemplate:null,initialDelimiter:"*$$*",initialPreview:"",initialCaption:"",initialPreviewCount:0,initialPreviewContent:"",overwriteInitial:!0,layoutTemplates:r,previewTemplates:o,allowedPreviewTypes:l,allowedPreviewMimeTypes:null,allowedFileTypes:null,allowedFileExtensions:null,previewSettings:s,fileTypeSettings:p,browseLabel:"Browse &hellip;",browseIcon:'<i class="glyphicon glyphicon-folder-open"></i> &nbsp;',browseClass:"btn btn-primary",removeLabel:"Remove",removeIcon:'<i class="glyphicon glyphicon-ban-circle"></i> ',removeClass:"btn btn-default",uploadLabel:"Upload",uploadIcon:'<i class="glyphicon glyphicon-upload"></i> ',uploadClass:"btn btn-default",uploadUrl:null,maxFileSize:0,maxFileCount:0,msgSizeTooLarge:'File "{name}" (<b>{size} KB</b>) exceeds maximum allowed upload size of <b>{maxSize} KB</b>. Please retry your upload!',msgFilesTooMany:"Number of files selected for upload <b>({n})</b> exceeds maximum allowed limit of <b>{m}</b>. Please retry your upload!",msgFileNotFound:'File "{name}" not found!',msgFileNotReadable:'File "{name}" is not readable.',msgFilePreviewAborted:'File preview aborted for "{name}".',msgFilePreviewError:'An error occurred while reading the file "{name}".',msgInvalidFileType:'Invalid type for file "{name}". Only "{types}" files are supported.',msgInvalidFileExtension:'Invalid extension for file "{name}". Only "{extensions}" files are supported.',msgValidationError:'<span class="text-danger"><i class="glyphicon glyphicon-exclamation-sign"></i> File Upload Error</span>',msgErrorClass:"file-error-message",msgLoading:"Loading  file {index} of {files} &hellip;",msgProgress:"Loading file {index} of {files} - {name} - {percent}% completed.",msgSelected:"{n} files selected",previewFileType:"image",wrapTextLength:250,wrapIndicator:' <span class="wrap-indicator" title="{title}" onclick="{dialog}">[&hellip;]</span>',elCaptionContainer:null,elCaptionText:null,elPreviewContainer:null,elPreviewImage:null,elPreviewStatus:null,elErrorContainer:null},e(document).ready(function(){var i=e("input.file[type=file]"),t=null!=i.attr("type")?i.length:0;t>0&&i.fileinput()})}(window.jQuery);
/* ------------------------------------------------------------------------------
*
*  # Bootstrap multiple file uploader
*
*  Specific JS code additions for uploader_bootstrap.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

    // Basic example
    $('.file-input').fileinput({
        browseLabel: '',
        browseClass: 'btn btn-primary btn-icon',
        removeLabel: '',
        uploadLabel: '',
        uploadClass: 'btn btn-default btn-icon',
        browseIcon: '<i class="icon-plus22"></i> ',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialCaption: "No file selected"
    });


    // With preview
    $(".file-input-preview").fileinput({
        browseLabel: '',
        browseClass: 'btn btn-primary btn-icon',
        removeLabel: '',
        uploadLabel: '',
        uploadClass: 'btn btn-default btn-icon',
        browseIcon: '<i class="icon-plus22"></i> ',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialPreview: [
            "<img src='assets/images/demo/images/1.png' class='file-preview-image' alt=''>",
            "<img src='assets/images/demo/images/2.png' class='file-preview-image' alt=''>",
        ],
        overwriteInitial: false,
        maxFileSize: 100
    });


    // Display preview on load
    $(".file-input-overwrite").fileinput({
        browseLabel: '',
        browseClass: 'btn btn-primary btn-icon',
        removeLabel: '',
        uploadLabel: '',
        uploadClass: 'btn btn-default btn-icon',
        browseIcon: '<i class="icon-plus22"></i> ',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialPreview: [
            "<img src='assets/images/demo/images/1.png' class='file-preview-image' alt=''>",
            "<img src='assets/images/demo/images/2.png' class='file-preview-image' alt=''>",
        ],
        overwriteInitial: true
    });


    // Custom layout
    $('.file-input-custom').fileinput({
        previewFileType: 'image',
        browseLabel: 'Select',
        browseClass: 'btn bg-slate-700',
        browseIcon: '<i class="icon-image2 position-left"></i> ',
        removeLabel: 'Remove',
        removeClass: 'btn btn-danger',
        removeIcon: '<i class="icon-cancel-square position-left"></i> ',
        uploadClass: 'btn bg-teal-400',
        uploadIcon: '<i class="icon-file-upload position-left"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialCaption: "No file selected"
    });


    // Advanced example
    $('.file-input-advanced').fileinput({
        browseLabel: 'Browse',
        browseClass: 'btn btn-default',
        removeLabel: '',
        uploadLabel: '',
        browseIcon: '<i class="icon-plus22 position-left"></i> ',
        uploadClass: 'btn btn-primary btn-icon',
        uploadIcon: '<i class="icon-file-upload"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        initialCaption: "No file selected",
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>',
            main1: "{preview}\n" +
            "<div class='input-group {class}'>\n" +
            "   <div class='input-group-btn'>\n" +
            "       {browse}\n" +
            "   </div>\n" +
            "   {caption}\n" +
            "   <div class='input-group-btn'>\n" +
            "       {upload}\n" +
            "       {remove}\n" +
            "   </div>\n" +
            "</div>"
        }
    });


    // Disable/enable button
    $("#btn-modify").on("click", function() {
        $btn = $(this);
        if ($btn.text() == "Disable file input") {
            $("#file-input-methods").fileinput("disable");
            $btn.html("Enable file input");
            alert("Hurray! I have disabled the input and hidden the upload button.");
        }
        else {
            $("#file-input-methods").fileinput("enable");
            $btn.html("Disable file input");
            alert("Hurray! I have reverted back the input to enabled with the upload button.");
        }
    });


    // Custom file extensions
    $(".file-input-extensions").fileinput({
        browseLabel: 'Browse',
        browseClass: 'btn btn-primary',
        removeLabel: '',
        browseIcon: '<i class="icon-plus22 position-left"></i> ',
        uploadIcon: '<i class="icon-file-upload position-left"></i> ',
        removeClass: 'btn btn-danger btn-icon',
        removeIcon: '<i class="icon-cancel-square"></i> ',
        layoutTemplates: {
            caption: '<div tabindex="-1" class="form-control file-caption {class}">\n' + '<span class="icon-file-plus kv-caption-icon"></span><div class="file-caption-name"></div>\n' + '</div>'
        },
        initialCaption: "No file selected",
        maxFilesNum: 10,
        allowedFileExtensions: ["jpg", "gif", "png", "txt"]
    });
    
});


/*
 *
 * More info at [www.dropzonejs.com](http://www.dropzonejs.com)
 *
 * Copyright (c) 2012, Matias Meno
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 */

(function() {
  var Dropzone, Emitter, camelize, contentLoaded, detectVerticalSquash, drawImageIOSFix, noop, without,
    __slice = [].slice,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  noop = function() {};

  Emitter = (function() {
    function Emitter() {}

    Emitter.prototype.addEventListener = Emitter.prototype.on;

    Emitter.prototype.on = function(event, fn) {
      this._callbacks = this._callbacks || {};
      if (!this._callbacks[event]) {
        this._callbacks[event] = [];
      }
      this._callbacks[event].push(fn);
      return this;
    };

    Emitter.prototype.emit = function() {
      var args, callback, callbacks, event, _i, _len;
      event = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      this._callbacks = this._callbacks || {};
      callbacks = this._callbacks[event];
      if (callbacks) {
        for (_i = 0, _len = callbacks.length; _i < _len; _i++) {
          callback = callbacks[_i];
          callback.apply(this, args);
        }
      }
      return this;
    };

    Emitter.prototype.removeListener = Emitter.prototype.off;

    Emitter.prototype.removeAllListeners = Emitter.prototype.off;

    Emitter.prototype.removeEventListener = Emitter.prototype.off;

    Emitter.prototype.off = function(event, fn) {
      var callback, callbacks, i, _i, _len;
      if (!this._callbacks || arguments.length === 0) {
        this._callbacks = {};
        return this;
      }
      callbacks = this._callbacks[event];
      if (!callbacks) {
        return this;
      }
      if (arguments.length === 1) {
        delete this._callbacks[event];
        return this;
      }
      for (i = _i = 0, _len = callbacks.length; _i < _len; i = ++_i) {
        callback = callbacks[i];
        if (callback === fn) {
          callbacks.splice(i, 1);
          break;
        }
      }
      return this;
    };

    return Emitter;

  })();

  Dropzone = (function(_super) {
    var extend, resolveOption;

    __extends(Dropzone, _super);

    Dropzone.prototype.Emitter = Emitter;


    /*
    This is a list of all available events you can register on a dropzone object.
    
    You can register an event handler like this:
    
        dropzone.on("dragEnter", function() { });
     */

    Dropzone.prototype.events = ["drop", "dragstart", "dragend", "dragenter", "dragover", "dragleave", "addedfile", "addedfiles", "removedfile", "thumbnail", "error", "errormultiple", "processing", "processingmultiple", "uploadprogress", "totaluploadprogress", "sending", "sendingmultiple", "success", "successmultiple", "canceled", "canceledmultiple", "complete", "completemultiple", "reset", "maxfilesexceeded", "maxfilesreached", "queuecomplete"];

    Dropzone.prototype.defaultOptions = {
      url: null,
      method: "post",
      withCredentials: false,
      parallelUploads: 2,
      uploadMultiple: false,
      maxFilesize: 256,
      paramName: "file",
      createImageThumbnails: true,
      maxThumbnailFilesize: 10,
      thumbnailWidth: 120,
      thumbnailHeight: 120,
      filesizeBase: 1000,
      maxFiles: null,
      params: {},
      clickable: true,
      ignoreHiddenFiles: true,
      acceptedFiles: null,
      acceptedMimeTypes: null,
      autoProcessQueue: true,
      autoQueue: true,
      addRemoveLinks: false,
      previewsContainer: null,
      hiddenInputContainer: "body",
      capture: null,
      dictDefaultMessage: "Drop files here to upload",
      dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
      dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
      dictFileTooBig: "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
      dictInvalidFileType: "You can't upload files of this type.",
      dictResponseError: "Server responded with {{statusCode}} code.",
      dictCancelUpload: "Cancel upload",
      dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
      dictRemoveFile: "Remove file",
      dictRemoveFileConfirmation: null,
      dictMaxFilesExceeded: "You can not upload any more files.",
      accept: function(file, done) {
        return done();
      },
      init: function() {
        return noop;
      },
      forceFallback: false,
      fallback: function() {
        var child, messageElement, span, _i, _len, _ref;
        this.element.className = "" + this.element.className + " dz-browser-not-supported";
        _ref = this.element.getElementsByTagName("div");
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          child = _ref[_i];
          if (/(^| )dz-message($| )/.test(child.className)) {
            messageElement = child;
            child.className = "dz-message";
            continue;
          }
        }
        if (!messageElement) {
          messageElement = Dropzone.createElement("<div class=\"dz-message\"><span></span></div>");
          this.element.appendChild(messageElement);
        }
        span = messageElement.getElementsByTagName("span")[0];
        if (span) {
          if (span.textContent != null) {
            span.textContent = this.options.dictFallbackMessage;
          } else if (span.innerText != null) {
            span.innerText = this.options.dictFallbackMessage;
          }
        }
        return this.element.appendChild(this.getFallbackForm());
      },
      resize: function(file) {
        var info, srcRatio, trgRatio;
        info = {
          srcX: 0,
          srcY: 0,
          srcWidth: file.width,
          srcHeight: file.height
        };
        srcRatio = file.width / file.height;
        info.optWidth = this.options.thumbnailWidth;
        info.optHeight = this.options.thumbnailHeight;
        if ((info.optWidth == null) && (info.optHeight == null)) {
          info.optWidth = info.srcWidth;
          info.optHeight = info.srcHeight;
        } else if (info.optWidth == null) {
          info.optWidth = srcRatio * info.optHeight;
        } else if (info.optHeight == null) {
          info.optHeight = (1 / srcRatio) * info.optWidth;
        }
        trgRatio = info.optWidth / info.optHeight;
        if (file.height < info.optHeight || file.width < info.optWidth) {
          info.trgHeight = info.srcHeight;
          info.trgWidth = info.srcWidth;
        } else {
          if (srcRatio > trgRatio) {
            info.srcHeight = file.height;
            info.srcWidth = info.srcHeight * trgRatio;
          } else {
            info.srcWidth = file.width;
            info.srcHeight = info.srcWidth / trgRatio;
          }
        }
        info.srcX = (file.width - info.srcWidth) / 2;
        info.srcY = (file.height - info.srcHeight) / 2;
        return info;
      },

      /*
      Those functions register themselves to the events on init and handle all
      the user interface specific stuff. Overwriting them won't break the upload
      but can break the way it's displayed.
      You can overwrite them if you don't like the default behavior. If you just
      want to add an additional event handler, register it on the dropzone object
      and don't overwrite those options.
       */
      drop: function(e) {
        return this.element.classList.remove("dz-drag-hover");
      },
      dragstart: noop,
      dragend: function(e) {
        return this.element.classList.remove("dz-drag-hover");
      },
      dragenter: function(e) {
        return this.element.classList.add("dz-drag-hover");
      },
      dragover: function(e) {
        return this.element.classList.add("dz-drag-hover");
      },
      dragleave: function(e) {
        return this.element.classList.remove("dz-drag-hover");
      },
      paste: noop,
      reset: function() {
        return this.element.classList.remove("dz-started");
      },
      addedfile: function(file) {
        var node, removeFileEvent, removeLink, _i, _j, _k, _len, _len1, _len2, _ref, _ref1, _ref2, _results;
        if (this.element === this.previewsContainer) {
          this.element.classList.add("dz-started");
        }
        if (this.previewsContainer) {
          file.previewElement = Dropzone.createElement(this.options.previewTemplate.trim());
          file.previewTemplate = file.previewElement;
          this.previewsContainer.appendChild(file.previewElement);
          _ref = file.previewElement.querySelectorAll("[data-dz-name]");
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            node.textContent = file.name;
          }
          _ref1 = file.previewElement.querySelectorAll("[data-dz-size]");
          for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
            node = _ref1[_j];
            node.innerHTML = this.filesize(file.size);
          }
          if (this.options.addRemoveLinks) {
            file._removeLink = Dropzone.createElement("<a class=\"dz-remove\" href=\"javascript:undefined;\" data-dz-remove>" + this.options.dictRemoveFile + "</a>");
            file.previewElement.appendChild(file._removeLink);
          }
          removeFileEvent = (function(_this) {
            return function(e) {
              e.preventDefault();
              e.stopPropagation();
              if (file.status === Dropzone.UPLOADING) {
                return Dropzone.confirm(_this.options.dictCancelUploadConfirmation, function() {
                  return _this.removeFile(file);
                });
              } else {
                if (_this.options.dictRemoveFileConfirmation) {
                  return Dropzone.confirm(_this.options.dictRemoveFileConfirmation, function() {
                    return _this.removeFile(file);
                  });
                } else {
                  return _this.removeFile(file);
                }
              }
            };
          })(this);
          _ref2 = file.previewElement.querySelectorAll("[data-dz-remove]");
          _results = [];
          for (_k = 0, _len2 = _ref2.length; _k < _len2; _k++) {
            removeLink = _ref2[_k];
            _results.push(removeLink.addEventListener("click", removeFileEvent));
          }
          return _results;
        }
      },
      removedfile: function(file) {
        var _ref;
        if (file.previewElement) {
          if ((_ref = file.previewElement) != null) {
            _ref.parentNode.removeChild(file.previewElement);
          }
        }
        return this._updateMaxFilesReachedClass();
      },
      thumbnail: function(file, dataUrl) {
        var thumbnailElement, _i, _len, _ref;
        if (file.previewElement) {
          file.previewElement.classList.remove("dz-file-preview");
          _ref = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            thumbnailElement = _ref[_i];
            thumbnailElement.alt = file.name;
            thumbnailElement.src = dataUrl;
          }
          return setTimeout(((function(_this) {
            return function() {
              return file.previewElement.classList.add("dz-image-preview");
            };
          })(this)), 1);
        }
      },
      error: function(file, message) {
        var node, _i, _len, _ref, _results;
        if (file.previewElement) {
          file.previewElement.classList.add("dz-error");
          if (typeof message !== "String" && message.error) {
            message = message.error;
          }
          _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
          _results = [];
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
          }
          return _results;
        }
      },
      errormultiple: noop,
      processing: function(file) {
        if (file.previewElement) {
          file.previewElement.classList.add("dz-processing");
          if (file._removeLink) {
            return file._removeLink.textContent = this.options.dictCancelUpload;
          }
        }
      },
      processingmultiple: noop,
      uploadprogress: function(file, progress, bytesSent) {
        var node, _i, _len, _ref, _results;
        if (file.previewElement) {
          _ref = file.previewElement.querySelectorAll("[data-dz-uploadprogress]");
          _results = [];
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            if (node.nodeName === 'PROGRESS') {
              _results.push(node.value = progress);
            } else {
              _results.push(node.style.width = "" + progress + "%");
            }
          }
          return _results;
        }
      },
      totaluploadprogress: noop,
      sending: noop,
      sendingmultiple: noop,
      success: function(file) {
        if (file.previewElement) {
          return file.previewElement.classList.add("dz-success");
        }
      },
      successmultiple: noop,
      canceled: function(file) {
        return this.emit("error", file, "Upload canceled.");
      },
      canceledmultiple: noop,
      complete: function(file) {
        if (file._removeLink) {
          file._removeLink.textContent = this.options.dictRemoveFile;
        }
        if (file.previewElement) {
          return file.previewElement.classList.add("dz-complete");
        }
      },
      completemultiple: noop,
      maxfilesexceeded: noop,
      maxfilesreached: noop,
      queuecomplete: noop,
      addedfiles: noop,
      previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-image\"><img data-dz-thumbnail /></div>\n  <div class=\"dz-details\">\n    <div class=\"dz-size\"><span data-dz-size></span></div>\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n  </div>\n  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n  <div class=\"dz-success-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Check</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n        <path d=\"M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" stroke-opacity=\"0.198794158\" stroke=\"#747474\" fill-opacity=\"0.816519475\" fill=\"#FFFFFF\" sketch:type=\"MSShapeGroup\"></path>\n      </g>\n    </svg>\n  </div>\n  <div class=\"dz-error-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Error</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n        <g id=\"Check-+-Oval-2\" sketch:type=\"MSLayerGroup\" stroke=\"#747474\" stroke-opacity=\"0.198794158\" fill=\"#FFFFFF\" fill-opacity=\"0.816519475\">\n          <path d=\"M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" sketch:type=\"MSShapeGroup\"></path>\n        </g>\n      </g>\n    </svg>\n  </div>\n</div>"
    };

    extend = function() {
      var key, object, objects, target, val, _i, _len;
      target = arguments[0], objects = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      for (_i = 0, _len = objects.length; _i < _len; _i++) {
        object = objects[_i];
        for (key in object) {
          val = object[key];
          target[key] = val;
        }
      }
      return target;
    };

    function Dropzone(element, options) {
      var elementOptions, fallback, _ref;
      this.element = element;
      this.version = Dropzone.version;
      this.defaultOptions.previewTemplate = this.defaultOptions.previewTemplate.replace(/\n*/g, "");
      this.clickableElements = [];
      this.listeners = [];
      this.files = [];
      if (typeof this.element === "string") {
        this.element = document.querySelector(this.element);
      }
      if (!(this.element && (this.element.nodeType != null))) {
        throw new Error("Invalid dropzone element.");
      }
      if (this.element.dropzone) {
        throw new Error("Dropzone already attached.");
      }
      Dropzone.instances.push(this);
      this.element.dropzone = this;
      elementOptions = (_ref = Dropzone.optionsForElement(this.element)) != null ? _ref : {};
      this.options = extend({}, this.defaultOptions, elementOptions, options != null ? options : {});
      if (this.options.forceFallback || !Dropzone.isBrowserSupported()) {
        return this.options.fallback.call(this);
      }
      if (this.options.url == null) {
        this.options.url = this.element.getAttribute("action");
      }
      if (!this.options.url) {
        throw new Error("No URL provided.");
      }
      if (this.options.acceptedFiles && this.options.acceptedMimeTypes) {
        throw new Error("You can't provide both 'acceptedFiles' and 'acceptedMimeTypes'. 'acceptedMimeTypes' is deprecated.");
      }
      if (this.options.acceptedMimeTypes) {
        this.options.acceptedFiles = this.options.acceptedMimeTypes;
        delete this.options.acceptedMimeTypes;
      }
      this.options.method = this.options.method.toUpperCase();
      if ((fallback = this.getExistingFallback()) && fallback.parentNode) {
        fallback.parentNode.removeChild(fallback);
      }
      if (this.options.previewsContainer !== false) {
        if (this.options.previewsContainer) {
          this.previewsContainer = Dropzone.getElement(this.options.previewsContainer, "previewsContainer");
        } else {
          this.previewsContainer = this.element;
        }
      }
      if (this.options.clickable) {
        if (this.options.clickable === true) {
          this.clickableElements = [this.element];
        } else {
          this.clickableElements = Dropzone.getElements(this.options.clickable, "clickable");
        }
      }
      this.init();
    }

    Dropzone.prototype.getAcceptedFiles = function() {
      var file, _i, _len, _ref, _results;
      _ref = this.files;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        file = _ref[_i];
        if (file.accepted) {
          _results.push(file);
        }
      }
      return _results;
    };

    Dropzone.prototype.getRejectedFiles = function() {
      var file, _i, _len, _ref, _results;
      _ref = this.files;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        file = _ref[_i];
        if (!file.accepted) {
          _results.push(file);
        }
      }
      return _results;
    };

    Dropzone.prototype.getFilesWithStatus = function(status) {
      var file, _i, _len, _ref, _results;
      _ref = this.files;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        file = _ref[_i];
        if (file.status === status) {
          _results.push(file);
        }
      }
      return _results;
    };

    Dropzone.prototype.getQueuedFiles = function() {
      return this.getFilesWithStatus(Dropzone.QUEUED);
    };

    Dropzone.prototype.getUploadingFiles = function() {
      return this.getFilesWithStatus(Dropzone.UPLOADING);
    };

    Dropzone.prototype.getAddedFiles = function() {
      return this.getFilesWithStatus(Dropzone.ADDED);
    };

    Dropzone.prototype.getActiveFiles = function() {
      var file, _i, _len, _ref, _results;
      _ref = this.files;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        file = _ref[_i];
        if (file.status === Dropzone.UPLOADING || file.status === Dropzone.QUEUED) {
          _results.push(file);
        }
      }
      return _results;
    };

    Dropzone.prototype.init = function() {
      var eventName, noPropagation, setupHiddenFileInput, _i, _len, _ref, _ref1;
      if (this.element.tagName === "form") {
        this.element.setAttribute("enctype", "multipart/form-data");
      }
      if (this.element.classList.contains("dropzone") && !this.element.querySelector(".dz-message")) {
        this.element.appendChild(Dropzone.createElement("<div class=\"dz-default dz-message\"><span>" + this.options.dictDefaultMessage + "</span></div>"));
      }
      if (this.clickableElements.length) {
        setupHiddenFileInput = (function(_this) {
          return function() {
            if (_this.hiddenFileInput) {
              _this.hiddenFileInput.parentNode.removeChild(_this.hiddenFileInput);
            }
            _this.hiddenFileInput = document.createElement("input");
            _this.hiddenFileInput.setAttribute("type", "file");
            if ((_this.options.maxFiles == null) || _this.options.maxFiles > 1) {
              _this.hiddenFileInput.setAttribute("multiple", "multiple");
            }
            _this.hiddenFileInput.className = "dz-hidden-input";
            if (_this.options.acceptedFiles != null) {
              _this.hiddenFileInput.setAttribute("accept", _this.options.acceptedFiles);
            }
            if (_this.options.capture != null) {
              _this.hiddenFileInput.setAttribute("capture", _this.options.capture);
            }
            _this.hiddenFileInput.style.visibility = "hidden";
            _this.hiddenFileInput.style.position = "absolute";
            _this.hiddenFileInput.style.top = "0";
            _this.hiddenFileInput.style.left = "0";
            _this.hiddenFileInput.style.height = "0";
            _this.hiddenFileInput.style.width = "0";
            document.querySelector(_this.options.hiddenInputContainer).appendChild(_this.hiddenFileInput);
            return _this.hiddenFileInput.addEventListener("change", function() {
              var file, files, _i, _len;
              files = _this.hiddenFileInput.files;
              if (files.length) {
                for (_i = 0, _len = files.length; _i < _len; _i++) {
                  file = files[_i];
                  _this.addFile(file);
                }
              }
              _this.emit("addedfiles", files);
              return setupHiddenFileInput();
            });
          };
        })(this);
        setupHiddenFileInput();
      }
      this.URL = (_ref = window.URL) != null ? _ref : window.webkitURL;
      _ref1 = this.events;
      for (_i = 0, _len = _ref1.length; _i < _len; _i++) {
        eventName = _ref1[_i];
        this.on(eventName, this.options[eventName]);
      }
      this.on("uploadprogress", (function(_this) {
        return function() {
          return _this.updateTotalUploadProgress();
        };
      })(this));
      this.on("removedfile", (function(_this) {
        return function() {
          return _this.updateTotalUploadProgress();
        };
      })(this));
      this.on("canceled", (function(_this) {
        return function(file) {
          return _this.emit("complete", file);
        };
      })(this));
      this.on("complete", (function(_this) {
        return function(file) {
          if (_this.getAddedFiles().length === 0 && _this.getUploadingFiles().length === 0 && _this.getQueuedFiles().length === 0) {
            return setTimeout((function() {
              return _this.emit("queuecomplete");
            }), 0);
          }
        };
      })(this));
      noPropagation = function(e) {
        e.stopPropagation();
        if (e.preventDefault) {
          return e.preventDefault();
        } else {
          return e.returnValue = false;
        }
      };
      this.listeners = [
        {
          element: this.element,
          events: {
            "dragstart": (function(_this) {
              return function(e) {
                return _this.emit("dragstart", e);
              };
            })(this),
            "dragenter": (function(_this) {
              return function(e) {
                noPropagation(e);
                return _this.emit("dragenter", e);
              };
            })(this),
            "dragover": (function(_this) {
              return function(e) {
                var efct;
                try {
                  efct = e.dataTransfer.effectAllowed;
                } catch (_error) {}
                e.dataTransfer.dropEffect = 'move' === efct || 'linkMove' === efct ? 'move' : 'copy';
                noPropagation(e);
                return _this.emit("dragover", e);
              };
            })(this),
            "dragleave": (function(_this) {
              return function(e) {
                return _this.emit("dragleave", e);
              };
            })(this),
            "drop": (function(_this) {
              return function(e) {
                noPropagation(e);
                return _this.drop(e);
              };
            })(this),
            "dragend": (function(_this) {
              return function(e) {
                return _this.emit("dragend", e);
              };
            })(this)
          }
        }
      ];
      this.clickableElements.forEach((function(_this) {
        return function(clickableElement) {
          return _this.listeners.push({
            element: clickableElement,
            events: {
              "click": function(evt) {
                if ((clickableElement !== _this.element) || (evt.target === _this.element || Dropzone.elementInside(evt.target, _this.element.querySelector(".dz-message")))) {
                  _this.hiddenFileInput.click();
                }
                return true;
              }
            }
          });
        };
      })(this));
      this.enable();
      return this.options.init.call(this);
    };

    Dropzone.prototype.destroy = function() {
      var _ref;
      this.disable();
      this.removeAllFiles(true);
      if ((_ref = this.hiddenFileInput) != null ? _ref.parentNode : void 0) {
        this.hiddenFileInput.parentNode.removeChild(this.hiddenFileInput);
        this.hiddenFileInput = null;
      }
      delete this.element.dropzone;
      return Dropzone.instances.splice(Dropzone.instances.indexOf(this), 1);
    };

    Dropzone.prototype.updateTotalUploadProgress = function() {
      var activeFiles, file, totalBytes, totalBytesSent, totalUploadProgress, _i, _len, _ref;
      totalBytesSent = 0;
      totalBytes = 0;
      activeFiles = this.getActiveFiles();
      if (activeFiles.length) {
        _ref = this.getActiveFiles();
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          file = _ref[_i];
          totalBytesSent += file.upload.bytesSent;
          totalBytes += file.upload.total;
        }
        totalUploadProgress = 100 * totalBytesSent / totalBytes;
      } else {
        totalUploadProgress = 100;
      }
      return this.emit("totaluploadprogress", totalUploadProgress, totalBytes, totalBytesSent);
    };

    Dropzone.prototype._getParamName = function(n) {
      if (typeof this.options.paramName === "function") {
        return this.options.paramName(n);
      } else {
        return "" + this.options.paramName + (this.options.uploadMultiple ? "[" + n + "]" : "");
      }
    };

    Dropzone.prototype.getFallbackForm = function() {
      var existingFallback, fields, fieldsString, form;
      if (existingFallback = this.getExistingFallback()) {
        return existingFallback;
      }
      fieldsString = "<div class=\"dz-fallback\">";
      if (this.options.dictFallbackText) {
        fieldsString += "<p>" + this.options.dictFallbackText + "</p>";
      }
      fieldsString += "<input type=\"file\" name=\"" + (this._getParamName(0)) + "\" " + (this.options.uploadMultiple ? 'multiple="multiple"' : void 0) + " /><input type=\"submit\" value=\"Upload!\"></div>";
      fields = Dropzone.createElement(fieldsString);
      if (this.element.tagName !== "FORM") {
        form = Dropzone.createElement("<form action=\"" + this.options.url + "\" enctype=\"multipart/form-data\" method=\"" + this.options.method + "\"></form>");
        form.appendChild(fields);
      } else {
        this.element.setAttribute("enctype", "multipart/form-data");
        this.element.setAttribute("method", this.options.method);
      }
      return form != null ? form : fields;
    };

    Dropzone.prototype.getExistingFallback = function() {
      var fallback, getFallback, tagName, _i, _len, _ref;
      getFallback = function(elements) {
        var el, _i, _len;
        for (_i = 0, _len = elements.length; _i < _len; _i++) {
          el = elements[_i];
          if (/(^| )fallback($| )/.test(el.className)) {
            return el;
          }
        }
      };
      _ref = ["div", "form"];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        tagName = _ref[_i];
        if (fallback = getFallback(this.element.getElementsByTagName(tagName))) {
          return fallback;
        }
      }
    };

    Dropzone.prototype.setupEventListeners = function() {
      var elementListeners, event, listener, _i, _len, _ref, _results;
      _ref = this.listeners;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        elementListeners = _ref[_i];
        _results.push((function() {
          var _ref1, _results1;
          _ref1 = elementListeners.events;
          _results1 = [];
          for (event in _ref1) {
            listener = _ref1[event];
            _results1.push(elementListeners.element.addEventListener(event, listener, false));
          }
          return _results1;
        })());
      }
      return _results;
    };

    Dropzone.prototype.removeEventListeners = function() {
      var elementListeners, event, listener, _i, _len, _ref, _results;
      _ref = this.listeners;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        elementListeners = _ref[_i];
        _results.push((function() {
          var _ref1, _results1;
          _ref1 = elementListeners.events;
          _results1 = [];
          for (event in _ref1) {
            listener = _ref1[event];
            _results1.push(elementListeners.element.removeEventListener(event, listener, false));
          }
          return _results1;
        })());
      }
      return _results;
    };

    Dropzone.prototype.disable = function() {
      var file, _i, _len, _ref, _results;
      this.clickableElements.forEach(function(element) {
        return element.classList.remove("dz-clickable");
      });
      this.removeEventListeners();
      _ref = this.files;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        file = _ref[_i];
        _results.push(this.cancelUpload(file));
      }
      return _results;
    };

    Dropzone.prototype.enable = function() {
      this.clickableElements.forEach(function(element) {
        return element.classList.add("dz-clickable");
      });
      return this.setupEventListeners();
    };

    Dropzone.prototype.filesize = function(size) {
      var cutoff, i, selectedSize, selectedUnit, unit, units, _i, _len;
      selectedSize = 0;
      selectedUnit = "b";
      if (size > 0) {
        units = ['TB', 'GB', 'MB', 'KB', 'b'];
        for (i = _i = 0, _len = units.length; _i < _len; i = ++_i) {
          unit = units[i];
          cutoff = Math.pow(this.options.filesizeBase, 4 - i) / 10;
          if (size >= cutoff) {
            selectedSize = size / Math.pow(this.options.filesizeBase, 4 - i);
            selectedUnit = unit;
            break;
          }
        }
        selectedSize = Math.round(10 * selectedSize) / 10;
      }
      return "<strong>" + selectedSize + "</strong> " + selectedUnit;
    };

    Dropzone.prototype._updateMaxFilesReachedClass = function() {
      if ((this.options.maxFiles != null) && this.getAcceptedFiles().length >= this.options.maxFiles) {
        if (this.getAcceptedFiles().length === this.options.maxFiles) {
          this.emit('maxfilesreached', this.files);
        }
        return this.element.classList.add("dz-max-files-reached");
      } else {
        return this.element.classList.remove("dz-max-files-reached");
      }
    };

    Dropzone.prototype.drop = function(e) {
      var files, items;
      if (!e.dataTransfer) {
        return;
      }
      this.emit("drop", e);
      files = e.dataTransfer.files;
      this.emit("addedfiles", files);
      if (files.length) {
        items = e.dataTransfer.items;
        if (items && items.length && (items[0].webkitGetAsEntry != null)) {
          this._addFilesFromItems(items);
        } else {
          this.handleFiles(files);
        }
      }
    };

    Dropzone.prototype.paste = function(e) {
      var items, _ref;
      if ((e != null ? (_ref = e.clipboardData) != null ? _ref.items : void 0 : void 0) == null) {
        return;
      }
      this.emit("paste", e);
      items = e.clipboardData.items;
      if (items.length) {
        return this._addFilesFromItems(items);
      }
    };

    Dropzone.prototype.handleFiles = function(files) {
      var file, _i, _len, _results;
      _results = [];
      for (_i = 0, _len = files.length; _i < _len; _i++) {
        file = files[_i];
        _results.push(this.addFile(file));
      }
      return _results;
    };

    Dropzone.prototype._addFilesFromItems = function(items) {
      var entry, item, _i, _len, _results;
      _results = [];
      for (_i = 0, _len = items.length; _i < _len; _i++) {
        item = items[_i];
        if ((item.webkitGetAsEntry != null) && (entry = item.webkitGetAsEntry())) {
          if (entry.isFile) {
            _results.push(this.addFile(item.getAsFile()));
          } else if (entry.isDirectory) {
            _results.push(this._addFilesFromDirectory(entry, entry.name));
          } else {
            _results.push(void 0);
          }
        } else if (item.getAsFile != null) {
          if ((item.kind == null) || item.kind === "file") {
            _results.push(this.addFile(item.getAsFile()));
          } else {
            _results.push(void 0);
          }
        } else {
          _results.push(void 0);
        }
      }
      return _results;
    };

    Dropzone.prototype._addFilesFromDirectory = function(directory, path) {
      var dirReader, entriesReader;
      dirReader = directory.createReader();
      entriesReader = (function(_this) {
        return function(entries) {
          var entry, _i, _len;
          for (_i = 0, _len = entries.length; _i < _len; _i++) {
            entry = entries[_i];
            if (entry.isFile) {
              entry.file(function(file) {
                if (_this.options.ignoreHiddenFiles && file.name.substring(0, 1) === '.') {
                  return;
                }
                file.fullPath = "" + path + "/" + file.name;
                return _this.addFile(file);
              });
            } else if (entry.isDirectory) {
              _this._addFilesFromDirectory(entry, "" + path + "/" + entry.name);
            }
          }
        };
      })(this);
      return dirReader.readEntries(entriesReader, function(error) {
        return typeof console !== "undefined" && console !== null ? typeof console.log === "function" ? console.log(error) : void 0 : void 0;
      });
    };

    Dropzone.prototype.accept = function(file, done) {
      if (file.size > this.options.maxFilesize * 1024 * 1024) {
        return done(this.options.dictFileTooBig.replace("{{filesize}}", Math.round(file.size / 1024 / 10.24) / 100).replace("{{maxFilesize}}", this.options.maxFilesize));
      } else if (!Dropzone.isValidFile(file, this.options.acceptedFiles)) {
        return done(this.options.dictInvalidFileType);
      } else if ((this.options.maxFiles != null) && this.getAcceptedFiles().length >= this.options.maxFiles) {
        done(this.options.dictMaxFilesExceeded.replace("{{maxFiles}}", this.options.maxFiles));
        return this.emit("maxfilesexceeded", file);
      } else {
        return this.options.accept.call(this, file, done);
      }
    };

    Dropzone.prototype.addFile = function(file) {
      file.upload = {
        progress: 0,
        total: file.size,
        bytesSent: 0
      };
      this.files.push(file);
      file.status = Dropzone.ADDED;
      this.emit("addedfile", file);
      this._enqueueThumbnail(file);
      return this.accept(file, (function(_this) {
        return function(error) {
          if (error) {
            file.accepted = false;
            _this._errorProcessing([file], error);
          } else {
            file.accepted = true;
            if (_this.options.autoQueue) {
              _this.enqueueFile(file);
            }
          }
          return _this._updateMaxFilesReachedClass();
        };
      })(this));
    };

    Dropzone.prototype.enqueueFiles = function(files) {
      var file, _i, _len;
      for (_i = 0, _len = files.length; _i < _len; _i++) {
        file = files[_i];
        this.enqueueFile(file);
      }
      return null;
    };

    Dropzone.prototype.enqueueFile = function(file) {
      if (file.status === Dropzone.ADDED && file.accepted === true) {
        file.status = Dropzone.QUEUED;
        if (this.options.autoProcessQueue) {
          return setTimeout(((function(_this) {
            return function() {
              return _this.processQueue();
            };
          })(this)), 0);
        }
      } else {
        throw new Error("This file can't be queued because it has already been processed or was rejected.");
      }
    };

    Dropzone.prototype._thumbnailQueue = [];

    Dropzone.prototype._processingThumbnail = false;

    Dropzone.prototype._enqueueThumbnail = function(file) {
      if (this.options.createImageThumbnails && file.type.match(/image.*/) && file.size <= this.options.maxThumbnailFilesize * 1024 * 1024) {
        this._thumbnailQueue.push(file);
        return setTimeout(((function(_this) {
          return function() {
            return _this._processThumbnailQueue();
          };
        })(this)), 0);
      }
    };

    Dropzone.prototype._processThumbnailQueue = function() {
      if (this._processingThumbnail || this._thumbnailQueue.length === 0) {
        return;
      }
      this._processingThumbnail = true;
      return this.createThumbnail(this._thumbnailQueue.shift(), (function(_this) {
        return function() {
          _this._processingThumbnail = false;
          return _this._processThumbnailQueue();
        };
      })(this));
    };

    Dropzone.prototype.removeFile = function(file) {
      if (file.status === Dropzone.UPLOADING) {
        this.cancelUpload(file);
      }
      this.files = without(this.files, file);
      this.emit("removedfile", file);
      if (this.files.length === 0) {
        return this.emit("reset");
      }
    };

    Dropzone.prototype.removeAllFiles = function(cancelIfNecessary) {
      var file, _i, _len, _ref;
      if (cancelIfNecessary == null) {
        cancelIfNecessary = false;
      }
      _ref = this.files.slice();
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        file = _ref[_i];
        if (file.status !== Dropzone.UPLOADING || cancelIfNecessary) {
          this.removeFile(file);
        }
      }
      return null;
    };

    Dropzone.prototype.createThumbnail = function(file, callback) {
      var fileReader;
      fileReader = new FileReader;
      fileReader.onload = (function(_this) {
        return function() {
          if (file.type === "image/svg+xml") {
            _this.emit("thumbnail", file, fileReader.result);
            if (callback != null) {
              callback();
            }
            return;
          }
          return _this.createThumbnailFromUrl(file, fileReader.result, callback);
        };
      })(this);
      return fileReader.readAsDataURL(file);
    };

    Dropzone.prototype.createThumbnailFromUrl = function(file, imageUrl, callback, crossOrigin) {
      var img;
      img = document.createElement("img");
      if (crossOrigin) {
        img.crossOrigin = crossOrigin;
      }
      img.onload = (function(_this) {
        return function() {
          var canvas, ctx, resizeInfo, thumbnail, _ref, _ref1, _ref2, _ref3;
          file.width = img.width;
          file.height = img.height;
          resizeInfo = _this.options.resize.call(_this, file);
          if (resizeInfo.trgWidth == null) {
            resizeInfo.trgWidth = resizeInfo.optWidth;
          }
          if (resizeInfo.trgHeight == null) {
            resizeInfo.trgHeight = resizeInfo.optHeight;
          }
          canvas = document.createElement("canvas");
          ctx = canvas.getContext("2d");
          canvas.width = resizeInfo.trgWidth;
          canvas.height = resizeInfo.trgHeight;
          drawImageIOSFix(ctx, img, (_ref = resizeInfo.srcX) != null ? _ref : 0, (_ref1 = resizeInfo.srcY) != null ? _ref1 : 0, resizeInfo.srcWidth, resizeInfo.srcHeight, (_ref2 = resizeInfo.trgX) != null ? _ref2 : 0, (_ref3 = resizeInfo.trgY) != null ? _ref3 : 0, resizeInfo.trgWidth, resizeInfo.trgHeight);
          thumbnail = canvas.toDataURL("image/png");
          _this.emit("thumbnail", file, thumbnail);
          if (callback != null) {
            return callback();
          }
        };
      })(this);
      if (callback != null) {
        img.onerror = callback;
      }
      return img.src = imageUrl;
    };

    Dropzone.prototype.processQueue = function() {
      var i, parallelUploads, processingLength, queuedFiles;
      parallelUploads = this.options.parallelUploads;
      processingLength = this.getUploadingFiles().length;
      i = processingLength;
      if (processingLength >= parallelUploads) {
        return;
      }
      queuedFiles = this.getQueuedFiles();
      if (!(queuedFiles.length > 0)) {
        return;
      }
      if (this.options.uploadMultiple) {
        return this.processFiles(queuedFiles.slice(0, parallelUploads - processingLength));
      } else {
        while (i < parallelUploads) {
          if (!queuedFiles.length) {
            return;
          }
          this.processFile(queuedFiles.shift());
          i++;
        }
      }
    };

    Dropzone.prototype.processFile = function(file) {
      return this.processFiles([file]);
    };

    Dropzone.prototype.processFiles = function(files) {
      var file, _i, _len;
      for (_i = 0, _len = files.length; _i < _len; _i++) {
        file = files[_i];
        file.processing = true;
        file.status = Dropzone.UPLOADING;
        this.emit("processing", file);
      }
      if (this.options.uploadMultiple) {
        this.emit("processingmultiple", files);
      }
      return this.uploadFiles(files);
    };

    Dropzone.prototype._getFilesWithXhr = function(xhr) {
      var file, files;
      return files = (function() {
        var _i, _len, _ref, _results;
        _ref = this.files;
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          file = _ref[_i];
          if (file.xhr === xhr) {
            _results.push(file);
          }
        }
        return _results;
      }).call(this);
    };

    Dropzone.prototype.cancelUpload = function(file) {
      var groupedFile, groupedFiles, _i, _j, _len, _len1, _ref;
      if (file.status === Dropzone.UPLOADING) {
        groupedFiles = this._getFilesWithXhr(file.xhr);
        for (_i = 0, _len = groupedFiles.length; _i < _len; _i++) {
          groupedFile = groupedFiles[_i];
          groupedFile.status = Dropzone.CANCELED;
        }
        file.xhr.abort();
        for (_j = 0, _len1 = groupedFiles.length; _j < _len1; _j++) {
          groupedFile = groupedFiles[_j];
          this.emit("canceled", groupedFile);
        }
        if (this.options.uploadMultiple) {
          this.emit("canceledmultiple", groupedFiles);
        }
      } else if ((_ref = file.status) === Dropzone.ADDED || _ref === Dropzone.QUEUED) {
        file.status = Dropzone.CANCELED;
        this.emit("canceled", file);
        if (this.options.uploadMultiple) {
          this.emit("canceledmultiple", [file]);
        }
      }
      if (this.options.autoProcessQueue) {
        return this.processQueue();
      }
    };

    resolveOption = function() {
      var args, option;
      option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      if (typeof option === 'function') {
        return option.apply(this, args);
      }
      return option;
    };

    Dropzone.prototype.uploadFile = function(file) {
      return this.uploadFiles([file]);
    };

    Dropzone.prototype.uploadFiles = function(files) {
      var file, formData, handleError, headerName, headerValue, headers, i, input, inputName, inputType, key, method, option, progressObj, response, updateProgress, url, value, xhr, _i, _j, _k, _l, _len, _len1, _len2, _len3, _m, _ref, _ref1, _ref2, _ref3, _ref4, _ref5;
      xhr = new XMLHttpRequest();
      for (_i = 0, _len = files.length; _i < _len; _i++) {
        file = files[_i];
        file.xhr = xhr;
      }
      method = resolveOption(this.options.method, files);
      url = resolveOption(this.options.url, files);
      xhr.open(method, url, true);
      xhr.withCredentials = !!this.options.withCredentials;
      response = null;
      handleError = (function(_this) {
        return function() {
          var _j, _len1, _results;
          _results = [];
          for (_j = 0, _len1 = files.length; _j < _len1; _j++) {
            file = files[_j];
            _results.push(_this._errorProcessing(files, response || _this.options.dictResponseError.replace("{{statusCode}}", xhr.status), xhr));
          }
          return _results;
        };
      })(this);
      updateProgress = (function(_this) {
        return function(e) {
          var allFilesFinished, progress, _j, _k, _l, _len1, _len2, _len3, _results;
          if (e != null) {
            progress = 100 * e.loaded / e.total;
            for (_j = 0, _len1 = files.length; _j < _len1; _j++) {
              file = files[_j];
              file.upload = {
                progress: progress,
                total: e.total,
                bytesSent: e.loaded
              };
            }
          } else {
            allFilesFinished = true;
            progress = 100;
            for (_k = 0, _len2 = files.length; _k < _len2; _k++) {
              file = files[_k];
              if (!(file.upload.progress === 100 && file.upload.bytesSent === file.upload.total)) {
                allFilesFinished = false;
              }
              file.upload.progress = progress;
              file.upload.bytesSent = file.upload.total;
            }
            if (allFilesFinished) {
              return;
            }
          }
          _results = [];
          for (_l = 0, _len3 = files.length; _l < _len3; _l++) {
            file = files[_l];
            _results.push(_this.emit("uploadprogress", file, progress, file.upload.bytesSent));
          }
          return _results;
        };
      })(this);
      xhr.onload = (function(_this) {
        return function(e) {
          var _ref;
          if (files[0].status === Dropzone.CANCELED) {
            return;
          }
          if (xhr.readyState !== 4) {
            return;
          }
          response = xhr.responseText;
          if (xhr.getResponseHeader("content-type") && ~xhr.getResponseHeader("content-type").indexOf("application/json")) {
            try {
              response = JSON.parse(response);
            } catch (_error) {
              e = _error;
              response = "Invalid JSON response from server.";
            }
          }
          updateProgress();
          if (!((200 <= (_ref = xhr.status) && _ref < 300))) {
            return handleError();
          } else {
            return _this._finished(files, response, e);
          }
        };
      })(this);
      xhr.onerror = (function(_this) {
        return function() {
          if (files[0].status === Dropzone.CANCELED) {
            return;
          }
          return handleError();
        };
      })(this);
      progressObj = (_ref = xhr.upload) != null ? _ref : xhr;
      progressObj.onprogress = updateProgress;
      headers = {
        "Accept": "application/json",
        "Cache-Control": "no-cache",
        "X-Requested-With": "XMLHttpRequest"
      };
      if (this.options.headers) {
        extend(headers, this.options.headers);
      }
      for (headerName in headers) {
        headerValue = headers[headerName];
        if (headerValue) {
          xhr.setRequestHeader(headerName, headerValue);
        }
      }
      formData = new FormData();
      if (this.options.params) {
        _ref1 = this.options.params;
        for (key in _ref1) {
          value = _ref1[key];
          formData.append(key, value);
        }
      }
      for (_j = 0, _len1 = files.length; _j < _len1; _j++) {
        file = files[_j];
        this.emit("sending", file, xhr, formData);
      }
      if (this.options.uploadMultiple) {
        this.emit("sendingmultiple", files, xhr, formData);
      }
      if (this.element.tagName === "FORM") {
        _ref2 = this.element.querySelectorAll("input, textarea, select, button");
        for (_k = 0, _len2 = _ref2.length; _k < _len2; _k++) {
          input = _ref2[_k];
          inputName = input.getAttribute("name");
          inputType = input.getAttribute("type");
          if (input.tagName === "SELECT" && input.hasAttribute("multiple")) {
            _ref3 = input.options;
            for (_l = 0, _len3 = _ref3.length; _l < _len3; _l++) {
              option = _ref3[_l];
              if (option.selected) {
                formData.append(inputName, option.value);
              }
            }
          } else if (!inputType || ((_ref4 = inputType.toLowerCase()) !== "checkbox" && _ref4 !== "radio") || input.checked) {
            formData.append(inputName, input.value);
          }
        }
      }
      for (i = _m = 0, _ref5 = files.length - 1; 0 <= _ref5 ? _m <= _ref5 : _m >= _ref5; i = 0 <= _ref5 ? ++_m : --_m) {
        formData.append(this._getParamName(i), files[i], files[i].name);
      }
      return this.submitRequest(xhr, formData, files);
    };

    Dropzone.prototype.submitRequest = function(xhr, formData, files) {
      return xhr.send(formData);
    };

    Dropzone.prototype._finished = function(files, responseText, e) {
      var file, _i, _len;
      for (_i = 0, _len = files.length; _i < _len; _i++) {
        file = files[_i];
        file.status = Dropzone.SUCCESS;
        this.emit("success", file, responseText, e);
        this.emit("complete", file);
      }
      if (this.options.uploadMultiple) {
        this.emit("successmultiple", files, responseText, e);
        this.emit("completemultiple", files);
      }
      if (this.options.autoProcessQueue) {
        return this.processQueue();
      }
    };

    Dropzone.prototype._errorProcessing = function(files, message, xhr) {
      var file, _i, _len;
      for (_i = 0, _len = files.length; _i < _len; _i++) {
        file = files[_i];
        file.status = Dropzone.ERROR;
        this.emit("error", file, message, xhr);
        this.emit("complete", file);
      }
      if (this.options.uploadMultiple) {
        this.emit("errormultiple", files, message, xhr);
        this.emit("completemultiple", files);
      }
      if (this.options.autoProcessQueue) {
        return this.processQueue();
      }
    };

    return Dropzone;

  })(Emitter);

  Dropzone.version = "4.2.0";

  Dropzone.options = {};

  Dropzone.optionsForElement = function(element) {
    if (element.getAttribute("id")) {
      return Dropzone.options[camelize(element.getAttribute("id"))];
    } else {
      return void 0;
    }
  };

  Dropzone.instances = [];

  Dropzone.forElement = function(element) {
    if (typeof element === "string") {
      element = document.querySelector(element);
    }
    if ((element != null ? element.dropzone : void 0) == null) {
      throw new Error("No Dropzone found for given element. This is probably because you're trying to access it before Dropzone had the time to initialize. Use the `init` option to setup any additional observers on your Dropzone.");
    }
    return element.dropzone;
  };

  Dropzone.autoDiscover = true;

  Dropzone.discover = function() {
    var checkElements, dropzone, dropzones, _i, _len, _results;
    if (document.querySelectorAll) {
      dropzones = document.querySelectorAll(".dropzone");
    } else {
      dropzones = [];
      checkElements = function(elements) {
        var el, _i, _len, _results;
        _results = [];
        for (_i = 0, _len = elements.length; _i < _len; _i++) {
          el = elements[_i];
          if (/(^| )dropzone($| )/.test(el.className)) {
            _results.push(dropzones.push(el));
          } else {
            _results.push(void 0);
          }
        }
        return _results;
      };
      checkElements(document.getElementsByTagName("div"));
      checkElements(document.getElementsByTagName("form"));
    }
    _results = [];
    for (_i = 0, _len = dropzones.length; _i < _len; _i++) {
      dropzone = dropzones[_i];
      if (Dropzone.optionsForElement(dropzone) !== false) {
        _results.push(new Dropzone(dropzone));
      } else {
        _results.push(void 0);
      }
    }
    return _results;
  };

  Dropzone.blacklistedBrowsers = [/opera.*Macintosh.*version\/12/i];

  Dropzone.isBrowserSupported = function() {
    var capableBrowser, regex, _i, _len, _ref;
    capableBrowser = true;
    if (window.File && window.FileReader && window.FileList && window.Blob && window.FormData && document.querySelector) {
      if (!("classList" in document.createElement("a"))) {
        capableBrowser = false;
      } else {
        _ref = Dropzone.blacklistedBrowsers;
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          regex = _ref[_i];
          if (regex.test(navigator.userAgent)) {
            capableBrowser = false;
            continue;
          }
        }
      }
    } else {
      capableBrowser = false;
    }
    return capableBrowser;
  };

  without = function(list, rejectedItem) {
    var item, _i, _len, _results;
    _results = [];
    for (_i = 0, _len = list.length; _i < _len; _i++) {
      item = list[_i];
      if (item !== rejectedItem) {
        _results.push(item);
      }
    }
    return _results;
  };

  camelize = function(str) {
    return str.replace(/[\-_](\w)/g, function(match) {
      return match.charAt(1).toUpperCase();
    });
  };

  Dropzone.createElement = function(string) {
    var div;
    div = document.createElement("div");
    div.innerHTML = string;
    return div.childNodes[0];
  };

  Dropzone.elementInside = function(element, container) {
    if (element === container) {
      return true;
    }
    while (element = element.parentNode) {
      if (element === container) {
        return true;
      }
    }
    return false;
  };

  Dropzone.getElement = function(el, name) {
    var element;
    if (typeof el === "string") {
      element = document.querySelector(el);
    } else if (el.nodeType != null) {
      element = el;
    }
    if (element == null) {
      throw new Error("Invalid `" + name + "` option provided. Please provide a CSS selector or a plain HTML element.");
    }
    return element;
  };

  Dropzone.getElements = function(els, name) {
    var e, el, elements, _i, _j, _len, _len1, _ref;
    if (els instanceof Array) {
      elements = [];
      try {
        for (_i = 0, _len = els.length; _i < _len; _i++) {
          el = els[_i];
          elements.push(this.getElement(el, name));
        }
      } catch (_error) {
        e = _error;
        elements = null;
      }
    } else if (typeof els === "string") {
      elements = [];
      _ref = document.querySelectorAll(els);
      for (_j = 0, _len1 = _ref.length; _j < _len1; _j++) {
        el = _ref[_j];
        elements.push(el);
      }
    } else if (els.nodeType != null) {
      elements = [els];
    }
    if (!((elements != null) && elements.length)) {
      throw new Error("Invalid `" + name + "` option provided. Please provide a CSS selector, a plain HTML element or a list of those.");
    }
    return elements;
  };

  Dropzone.confirm = function(question, accepted, rejected) {
    if (window.confirm(question)) {
      return accepted();
    } else if (rejected != null) {
      return rejected();
    }
  };

  Dropzone.isValidFile = function(file, acceptedFiles) {
    var baseMimeType, mimeType, validType, _i, _len;
    if (!acceptedFiles) {
      return true;
    }
    acceptedFiles = acceptedFiles.split(",");
    mimeType = file.type;
    baseMimeType = mimeType.replace(/\/.*$/, "");
    for (_i = 0, _len = acceptedFiles.length; _i < _len; _i++) {
      validType = acceptedFiles[_i];
      validType = validType.trim();
      if (validType.charAt(0) === ".") {
        if (file.name.toLowerCase().indexOf(validType.toLowerCase(), file.name.length - validType.length) !== -1) {
          return true;
        }
      } else if (/\/\*$/.test(validType)) {
        if (baseMimeType === validType.replace(/\/.*$/, "")) {
          return true;
        }
      } else {
        if (mimeType === validType) {
          return true;
        }
      }
    }
    return false;
  };

  if (typeof jQuery !== "undefined" && jQuery !== null) {
    jQuery.fn.dropzone = function(options) {
      return this.each(function() {
        return new Dropzone(this, options);
      });
    };
  }

  if (typeof module !== "undefined" && module !== null) {
    module.exports = Dropzone;
  } else {
    window.Dropzone = Dropzone;
  }

  Dropzone.ADDED = "added";

  Dropzone.QUEUED = "queued";

  Dropzone.ACCEPTED = Dropzone.QUEUED;

  Dropzone.UPLOADING = "uploading";

  Dropzone.PROCESSING = Dropzone.UPLOADING;

  Dropzone.CANCELED = "canceled";

  Dropzone.ERROR = "error";

  Dropzone.SUCCESS = "success";


  /*
  
  Bugfix for iOS 6 and 7
  Source: http://stackoverflow.com/questions/11929099/html5-canvas-drawimage-ratio-bug-ios
  based on the work of https://github.com/stomita/ios-imagefile-megapixel
   */

  detectVerticalSquash = function(img) {
    var alpha, canvas, ctx, data, ey, ih, iw, py, ratio, sy;
    iw = img.naturalWidth;
    ih = img.naturalHeight;
    canvas = document.createElement("canvas");
    canvas.width = 1;
    canvas.height = ih;
    ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);
    data = ctx.getImageData(0, 0, 1, ih).data;
    sy = 0;
    ey = ih;
    py = ih;
    while (py > sy) {
      alpha = data[(py - 1) * 4 + 3];
      if (alpha === 0) {
        ey = py;
      } else {
        sy = py;
      }
      py = (ey + sy) >> 1;
    }
    ratio = py / ih;
    if (ratio === 0) {
      return 1;
    } else {
      return ratio;
    }
  };

  drawImageIOSFix = function(ctx, img, sx, sy, sw, sh, dx, dy, dw, dh) {
    var vertSquashRatio;
    vertSquashRatio = detectVerticalSquash(img);
    return ctx.drawImage(img, sx, sy, sw, sh, dx, dy, dw, dh / vertSquashRatio);
  };


  /*
   * contentloaded.js
   *
   * Author: Diego Perini (diego.perini at gmail.com)
   * Summary: cross-browser wrapper for DOMContentLoaded
   * Updated: 20101020
   * License: MIT
   * Version: 1.2
   *
   * URL:
   * http://javascript.nwbox.com/ContentLoaded/
   * http://javascript.nwbox.com/ContentLoaded/MIT-LICENSE
   */

  contentLoaded = function(win, fn) {
    var add, doc, done, init, poll, pre, rem, root, top;
    done = false;
    top = true;
    doc = win.document;
    root = doc.documentElement;
    add = (doc.addEventListener ? "addEventListener" : "attachEvent");
    rem = (doc.addEventListener ? "removeEventListener" : "detachEvent");
    pre = (doc.addEventListener ? "" : "on");
    init = function(e) {
      if (e.type === "readystatechange" && doc.readyState !== "complete") {
        return;
      }
      (e.type === "load" ? win : doc)[rem](pre + e.type, init, false);
      if (!done && (done = true)) {
        return fn.call(win, e.type || e);
      }
    };
    poll = function() {
      var e;
      try {
        root.doScroll("left");
      } catch (_error) {
        e = _error;
        setTimeout(poll, 50);
        return;
      }
      return init("poll");
    };
    if (doc.readyState !== "complete") {
      if (doc.createEventObject && root.doScroll) {
        try {
          top = !win.frameElement;
        } catch (_error) {}
        if (top) {
          poll();
        }
      }
      doc[add](pre + "DOMContentLoaded", init, false);
      doc[add](pre + "readystatechange", init, false);
      return win[add](pre + "load", init, false);
    }
  };

  Dropzone._autoDiscoverFunction = function() {
    if (Dropzone.autoDiscover) {
      return Dropzone.discover();
    }
  };

  contentLoaded(window, Dropzone._autoDiscoverFunction);

}).call(this);

//# sourceMappingURL=userCreate.js.map
