CKEDITOR.skin.name="moono",CKEDITOR.skin.ua_editor="ie,iequirks,ie7,ie8,gecko",CKEDITOR.skin.ua_dialog="ie,iequirks,ie7,ie8",CKEDITOR.skin.chameleon=function(){var o=function(o,e){for(var r=o.match(/[^#]./g),t=0;3>t;t++){var d,c=t;d=parseInt(r[t],16),d=("0"+(0>e?0|d*(1+e):0|d+(255-d)*e).toString(16)).slice(-2),r[c]=d}return"#"+r.join("")},e=function(){var o=new CKEDITOR.template("background:#{to};background-image:linear-gradient(to bottom,{from},{to});filter:progid:DXImageTransform.Microsoft.gradient(gradientType=0,startColorstr='{from}',endColorstr='{to}');");return function(e,r){return o.output({from:e,to:r})}}(),r={editor:new CKEDITOR.template("{id}.cke_chrome [border-color:{defaultBorder};] {id} .cke_top [ {defaultGradient}border-bottom-color:{defaultBorder};] {id} .cke_bottom [{defaultGradient}border-top-color:{defaultBorder};] {id} .cke_resizer [border-right-color:{ckeResizer}] {id} .cke_dialog_title [{defaultGradient}border-bottom-color:{defaultBorder};] {id} .cke_dialog_footer [{defaultGradient}outline-color:{defaultBorder};border-top-color:{defaultBorder};] {id} .cke_dialog_tab [{lightGradient}border-color:{defaultBorder};] {id} .cke_dialog_tab:hover [{mediumGradient}] {id} .cke_dialog_contents [border-top-color:{defaultBorder};] {id} .cke_dialog_tab_selected, {id} .cke_dialog_tab_selected:hover [background:{dialogTabSelected};border-bottom-color:{dialogTabSelectedBorder};] {id} .cke_dialog_body [background:{dialogBody};border-color:{defaultBorder};] {id} .cke_toolgroup [{lightGradient}border-color:{defaultBorder};] {id} a.cke_button_off:hover, {id} a.cke_button_off:focus, {id} a.cke_button_off:active [{mediumGradient}] {id} .cke_button_on [{ckeButtonOn}] {id} .cke_toolbar_separator [background-color: {ckeToolbarSeparator};] {id} .cke_combo_button [border-color:{defaultBorder};{lightGradient}] {id} a.cke_combo_button:hover, {id} a.cke_combo_button:focus, {id} .cke_combo_on a.cke_combo_button [border-color:{defaultBorder};{mediumGradient}] {id} .cke_path_item [color:{elementsPathColor};] {id} a.cke_path_item:hover, {id} a.cke_path_item:focus, {id} a.cke_path_item:active [background-color:{elementsPathBg};] {id}.cke_panel [border-color:{defaultBorder};] "),panel:new CKEDITOR.template(".cke_panel_grouptitle [{lightGradient}border-color:{defaultBorder};] .cke_menubutton_icon [background-color:{menubuttonIcon};] .cke_menubutton:hover .cke_menubutton_icon, .cke_menubutton:focus .cke_menubutton_icon, .cke_menubutton:active .cke_menubutton_icon [background-color:{menubuttonIconHover};] .cke_menuseparator [background-color:{menubuttonIcon};] a:hover.cke_colorbox, a:focus.cke_colorbox, a:active.cke_colorbox [border-color:{defaultBorder};] a:hover.cke_colorauto, a:hover.cke_colormore, a:focus.cke_colorauto, a:focus.cke_colormore, a:active.cke_colorauto, a:active.cke_colormore [background-color:{ckeColorauto};border-color:{defaultBorder};] ")};return function(t,d){var c=t.uiColor;c={id:"."+t.id,defaultBorder:o(c,-.1),defaultGradient:e(o(c,.9),c),lightGradient:e(o(c,1),o(c,.7)),mediumGradient:e(o(c,.8),o(c,.5)),ckeButtonOn:e(o(c,.6),o(c,.7)),ckeResizer:o(c,-.4),ckeToolbarSeparator:o(c,.5),ckeColorauto:o(c,.8),dialogBody:o(c,.7),dialogTabSelected:e("#FFFFFF","#FFFFFF"),dialogTabSelectedBorder:"#FFF",elementsPathColor:o(c,-.6),elementsPathBg:c,menubuttonIcon:o(c,.5),menubuttonIconHover:o(c,.3)};return r[d].output(c).replace(/\[/g,"{").replace(/\]/g,"}")}}();