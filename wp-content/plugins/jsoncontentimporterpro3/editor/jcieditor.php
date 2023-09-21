<?php
# version 20210904

class JCIeditor {
	private $textareaname = '';
	private $templatecontent = '';
	private $templatetheme = ''; # ace
	private $templatefontsize = ''; 
	private $templatewidth = 0;
	private $templateheight = 0; 
	private $templatelineheight = 0;
	private $language = '';
	private $twigSyntax = NULL;

	public function __construct($textareaname, $templatecontent, $language = "twig", 
									$templatetheme='merbivore', $templatefontsize='14px',
									$templatewidth = "800px", $templateheight = "600px",
									$templatelineheight = 1.6
	){
		$this->textareaname = $textareaname;
		#$templatecontent = urldecode($templatecontent); # ok for template, also for jsonuseset??
		#preg_replace("/##jciform##/i", "form", $templatecontent); 
		$this->templatecontent = $templatecontent;
		$this->templatetheme = $templatetheme;
		if (empty($this->templatetheme)) {
			$this->templatetheme = 'merbivore';
		}
		$this->templatefontsize = $templatefontsize;
		if (empty($this->templatefontsize)) {
			$this->templatefontsize = '14px';
		}
		$this->templatewidth = $templatewidth;
		if (empty($this->templatewidth)) {
			$this->templatewidth = '800px';
		}
		$this->templateheight = $templateheight;
		if (empty($this->templateheight)) {
			$this->templateheight = '600px';
		}
		$this->templatelineheight = $templatelineheight;
		if (empty($this->templatelineheight)) {
			$this->templatelineheight = 1.6;
		}
		$this->language = $language;
		if (empty($this->language)) {
			$this->language = 'twig';
		}
	}

	public function escpaeSpecialChars4JS($txt){  # prepare string for using with JS
		$txt = preg_replace("/\<\/script\>/", '<\/script>', $txt);
		
		
		
		$txt = preg_replace("/\r?\n/", "\\n", addslashes($txt) );
		return $txt;
		#$txt = preg_replace("/\'/", "\\'", $txt);
		#$txt = preg_replace("/\n/", "\\n", $txt);
		#$txt = preg_replace("/\r/", "\\r", $txt);
		#return $txt;
	}

	public function getAceTwigSyntaxShorts(){  
		return $this->twigSyntax;
	}

	public function showAceEditor(){
		#echo "<hr>".($this->templatecontent)."<hr>";
		$templatecontent = $this->escpaeSpecialChars4JS($this->templatecontent);
		#echo "<hr>showAceEditor2:".($templatecontent)."<hr>";

		echo '<textarea style="display:none;" placeholder="" name="'.$this->textareaname.'" id="'.$this->textareaname.'" ></textarea>';
		#echo '<pre id="aceeditor">'.$templatecontent.'</pre>'; # causes problems <form>...</form>
		echo '<pre id="aceeditor"></pre>'; 
		echo '<script src="'.plugin_dir_url( __FILE__ ).'../js/jquery/jquery-3.6.1.min.js" type="text/javascript" charset="utf-8"></script>';
		echo '<script src="'.plugin_dir_url( __FILE__ ).'editor_ace/ace.js" type="text/javascript" charset="utf-8"></script>';
		echo '<script src="'.plugin_dir_url( __FILE__ ).'editor_ace/ext-language_tools.js" type="text/javascript" charset="utf-8"></script>';
		echo '<script>';
		echo '	var aceeditor = ace.edit("aceeditor");';
				
		echo '	aceeditor.setTheme("ace/theme/'.$this->templatetheme.'");';
		echo '	aceeditor.getSession().setMode("ace/mode/'.$this->language.'");';
		echo '	aceeditor.session.setUseWrapMode(true);';
		echo '	aceeditor.setHighlightActiveLine(true);';
		echo '	aceeditor.setShowPrintMargin(false);';
		
		echo '  let langTools = ace.require("ace/ext/language_tools");
				aceeditor.setOptions({
					maxLines: Infinity,
					minLines: 40,
					enableBasicAutocompletion: true,
					enableLiveAutocompletion: true,
				});';
		$twigSyntax = array();
		$twigSyntax["json_decode"] = '{% set jsonArray = (JSONString | json_decode(TRUE)) %}';
		#$twigSyntax["jci_db_update"] = '{% set SQL = "SELECT .... FROM... WHERE..." %}\n{% set up = jci_db_update(SQL) %}';
		$twigSyntax["for loop"] = '{% for i in JSONARRAY %}\n\n{% endfor %}';
		$twigSyntax["for slice"] = '{% for i in JSONARRAY |slice(0,1) %}\n{% endfor %}';
		$twigSyntax["doshortcode"] = '{% set paramval = "PARAMVAL" %}\n{% set shortcodeString = "[SHORTCODE shortcodeparamkey="~paramval~"]" %}\n{% set shortcodeResult = (shortcodeString | doshortcode) %}';

		$twigSyntax["date"] = '{% set currenttimestamp = ("now"|date("Y/m/d")) %}\n{% set outdate = (currenttimestamp|date("m/d/Y")) %}';
		$twigSyntax["date timezone format"] = '{% set currenttimestamp = ("now"|date("Y/m/d H:i:s")) %}\n{{ currenttimestamp | dateformat("%A %m/%d/%y %H:%M:%S", "Europe/Berlin", "nl_NL")}}';


		$twigSyntax["round"] = '{{ NUMBER|round(INTEGER_PRECISION, "floor/ceil/common") }}';
		$twigSyntax["url_encode"] = '{% set instr="WELcome !" %}{{instr}} {{ instr | url_encode }}';
		#$twigSyntax["slice"] = '{% set instr="WELcome" %}{{instr}} {{ instr | slice(2, 3) }}';
		$twigSyntax["json_encode"] = '{{ ARRAY | json_encode() }}';
		$twigSyntax["lower"] = '{% set instr="WELcome" %}{{instr}} {{ instr | lower }}';
		$twigSyntax["number_format"] = '{% set innr=32423313.5435352352 %}{{innr}}\n{% set outnr = (innr | number_format(3, ".", "-")) %}{{outnr}}';
		$twigSyntax["if"] = '{% if 1==2 %}\n  {% else %}\n{% endif %}';
		$twigSyntax["set"] = '{% set avariable = "VALUE" %}';
		$twigSyntax["if matches"] = '{% if "WELCOME" matches "/E$}/" %}\nDo Stuff\n{% endif %}';
		
		$twigSyntax["sortbyjsonfield"] = '{% for item in JSONARRAY | sortbyjsonfield("JSONFIELD,desc,num") %}\n\n{% endfor %}';

		$twigSyntax["get_headers"] = '{% set headerOfImage = get_headers("https://json-content-importer.com/extra/images/jci-logo-144x144.png") %}';

		$twigSyntax["converthex2ascii"] = '{{ "WELCOME" | converthex2ascii }}';
		$twigSyntax["convert2html"] = '{% set instr="<b>welcome</b>"%}{{instr}} {% set outstr = ( instr | convert2html) %} - {{outstr}}';
		$twigSyntax["md5"] = '{% set instr="whatever"%} {{ whatever | md5 }}';
		$twigSyntax["dump"] = '{{ "WELCOME" | dump }}';
		$twigSyntax["preg_replace"] = '{% set instr="welcome"%}{{instr}} {% set outstr = ( instr | preg_replace("/WEL/i", "BE")) %} - {{outstr}}';
		$twigSyntax["converthex2ascii"] = '{{ "WELCOME" | converthex2ascii }}';
		
		$twigSyntax["wp_new_custom_post"] = '{% set newpageid = wp_new_custom_post(posttype, titel, pageslug, content, excerpt, publishdate, "postStatusUsed, default publish: publish, future, draft, pending, private", authorid, debug) %}';
		$twigSyntax["wp_update_custom_post"] = '{% set val = wp_update_custom_post(pageid, titel, pageslug, content, excerpt, publishdate, "postStatusUsed, default publish: publish, future, draft, pending, private", authorid, debug) %}';
		$twigSyntax["wp_delete_custom_post"] = '{% set delcpt = wp_delete_custom_post(postid, force_delete, debug) %}';

		$twigSyntax["wp_mediastore"] = '{% set newmedia = wp_mediastore("url or filename to new media", "parentPageId: if set, the new media is attached to this pageid", "title of new media", "slug aka url of new media", "content: text to new media", "excerpt: short text to new media", "publishdate", "postStatusUsed: publish, future, draft, pending, private", "wp-id of authorid, if not set current userid", "sourcetype: if file check for local files on server, see source 1st argument of this funtion", "withpath, default TRUE: if FALSE remove path from medianame", "removeqm, default FALSE: if TRUE remove ...?whatever= from medianame", "generate_thumbnails, default TRUE: if FALSE do NOT generate thumbnails (consumes much time...", "loadContext - JSON for http-request: example: {\"http\": {\"method\": \"GET\", \"header\": [\"Accept-language: en\r\n Cookie: foo=bar\r\n\"]}}") %}';
		
		$twigSyntax["wp_mediafilename"] = '{% set mediafilename = wp_mediafilename("url or filename to new media", "withpath, default TRUE: if FALSE remove path from medianame", "removeqm, default FALSE: if TRUE remove ...?whatever= from medianame", "sourcetype: if file check for local files on server, see source 1st argument of this funtion" ) %}{{mediafilename}}';
		$twigSyntax["wp_medialist"] = '{% set medialist = wp_medialist("postid - otional", "search pattern") %}{{medialist| dump}}';
		
		$twigSyntax["wp_insert_custom_field_keyvalue"] = '{% set newcpf = wp_insert_custom_field_keyvalue(pageid, key, value, debug) %}';
		$twigSyntax["wp_get_cp_by_cpf_keyvalue"] = '{% set listofcpp = wp_get_cp_by_cpf_keyvalue(post_type, key, value, debug) %}';
		
		$twigSyntax["wp_get_page_properties"] = '{% set pageprop = wp_get_page_properties() %}{% set pageid = pageprop.get_post.ID %}{% set cpfjson = pageprop.cpf %}';


		$twigSyntax["wp_get_custom_field_value"] = '{% set val = wp_get_custom_field_value(pageid, key, debug) %}';
		
		$twigSyntax["wp_set_featured_image"] = '{% set val = wp_set_featured_image(postid, thumbnail_id) %}';
		
		$twigSyntax["wp_get_attachment_image_url"] = '{% set imgurl = wp_get_attachment_image_url(attachment_id, size="thumbnail full medium large...") %}';
		
		echo '	var twigTables = [';
		$this->twigSyntax = $twigSyntax;
		foreach($this->twigSyntax as $k => $v) {
			echo '{ name: \''.$k.'\', description: \'{{ JSON | json_decode }}\', syntax: \''.$v.'\' },';
		}		
		echo '		];	
				var twigTablesCompleter = {
					getCompletions: function(editor, session, pos, prefix, callback) {
						callback(null, twigTables.map(function(table) {
							return {
								caption: table.syntax,
								value: table.syntax,
								meta: table.name
							};
						}));	
					}
				};
			langTools.addCompleter(twigTablesCompleter);	
		';

		echo '	aceeditor.container.style.lineHeight = '.$this->templatelineheight.';';
		echo '	document.getElementById("aceeditor").style.position = "relative";	';
		echo '	document.getElementById("aceeditor").style.height = "'.$this->templateheight.'";	';
		echo '	document.getElementById("aceeditor").style.width = "'.$this->templatewidth.'";	';
		echo '	document.getElementById("aceeditor").style.fontSize="'.$this->templatefontsize.'";';
		echo ' 	aceeditor.setValue(\''.$templatecontent.'\');';
		echo '	jqaceeditor = jQuery.noConflict( true );';
		echo '	var textarea = jqaceeditor(\'textarea[name="'.$this->textareaname.'"]\'); ';
		echo '	var acetextarea = aceeditor.getValue(); ';
		echo '	acetextarea = encodeURIComponent(acetextarea); ';
		echo '	console.log(" initial acetextarea: " + acetextarea); ';
		echo '  textarea.val(acetextarea);';
		echo '	aceeditor.getSession().on("change", function () { 
					var acetextarea = aceeditor.getValue(); 
					acetextarea = encodeURIComponent(acetextarea); 
					console.log(" update acetextarea: " + acetextarea); 
					textarea.val(acetextarea);
				});';
		echo '</script>';
	}
}
?>