try{jQuery(document).ready(function(a){let has_css_in_head=false;a("head style").each(function(){if(a(this).html().indexOf(WidgetCssfacebook.selector)!=-1){has_css_in_head=true}});if(!has_css_in_head){a.post(WidgetCssfacebook.ajaxurl,{action:WidgetCssfacebook.action,security:WidgetCssfacebook.security},function(b){a("head").append('<style type="text/css">'+b+"</style>");a(WidgetCssfacebook.selector).show();if(typeof Trustindex!="undefined"){Trustindex.resize_widgets()}})}else{a(WidgetCssfacebook.selector).show()}});}catch(e){}