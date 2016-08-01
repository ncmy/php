/**
 * jQuery Plugin for creating AJAX auto-suggest textfield
 * @version 2.1
 * @requires jQuery 1.4 or later
 *
 * Copyright (c) 2011 Lucky
 * Licensed under the GPL license:
 *   http://www.gnu.org/licenses/gpl.html
 */

(function($) {
	function autosuggest(callBackUrl, textField){
		this.divId="suggestions_holder";
		this.hovered=false;
		this.arrData=null;

		this.textField=textField;
		this.callBackUrl=callBackUrl;

		var width=this.textField.width()+14;//这里可以调整自动完成的宽度
		var minChars=1;
		var currRow=0;
		var suggestRow="suggest_row";
		var suggestItem="suggest_item";

		this.idField=null;
		this.submitOnSelect=false;
		this.thumbnail=false;
		this.description=false;
		//调协大DIV的样式，也就是宽度滚动条的样式
		this.textField.after('<div class="suggestions" style="max-height:600px;min-height:300px;overflow-x:hidden;overflow-y:auto;" id="' + this.divId + '"></div>');
		this.textField.attr("autocomplete", "off");

		this.holder=this.textField.next("#" + this.divId);
		this.holder.hide();

		this.onSelected=null;
		//这里是加的获取汉字的字数
		this.getLength = function(str){  
			return str.replace(/[^\x00-\xff]/g,"aa").length;
		};  
		var me=this;
		this.textField.keyup(
			function(e){
				if(e.keyCode!=37 && e.keyCode!=38 && e.keyCode!=39 && e.keyCode!=40 && e.keyCode!=13){
					if(me.getLength($(this).val())>=minChars){
						$.ajax({
							url:me.callBackUrl + encodeURI($(this).val()),
							success:function(data){
								try{
									me.arrData=$.parseJSON(data);

									var arr=me.arrData;
									for(var o in arr){
										console.debug(o+"  "+arr[o]);
									}
									var html="";

									currRow=0;

									if(arr==null){
										me.hide();
									}
									else{
										if(arr.length>0){
											for(i=0;i<arr.length;i++){
												cssClass=suggestItem;

												if(i==0){
													cssClass+=" first";
												}
												if(i==(arr.length-1)){
													cssClass+=" last";
												}

												var id_field='';
												if(me.idField!=null){
													id_field=' id_field="' + arr[i].id + '"';
												}

												var thumb="";
												if(me.thumbnail==true){
													var style="";
													if(arr[i].thumbnail!=undefined){
														//这里可以更改头像或商标
														//width:20px;height:20px;margin-top:5px;margin-right:15px;或是更改图片属性
														style=' style="background-image:url(/waimai/public/home/index/images/index_pannel.png);float:left;line-height:50px;"';
													}
													thumb='<div class="thumbnail"' + style + '></div>';
												}

												var desc="";
												if(me.description==true){
													if(arr[i].description!=undefined){
														desc='<div class="description" style="text-align:left;font-style:italic;font-size:12px;color:red;width:150px;margin-top:25px;padding-top:5px;">附近有' + arr[i].description + '家外卖</div>';
													}
												}
												var data_source=arr[i].data.replace(new RegExp('(' + me.textField.val() + ')', 'gi'), "<b style='color:red;'>$1</b>") ;
												html+='<div id="' + suggestRow + (i+1) + '" class="' + cssClass + '"' + id_field + ' seq_id="' + i + '" >' + thumb + '<div class="suggestion_title" style="text-align:left;float:left;margin-top:13px;color: #333333;">' +data_source.replace(/(\d+)$/gi, "<b style='color:red;font-size:10px;font-style:italic'>附近有$1家外卖</b>") + '</div>' + desc + '</div>';
											}

											me.holder.html(html);

											for(i=1;i<=arr.length;i++){
												var target=me.holder.find("#" + suggestRow + i);
												target.mouseover(function(e){
													me.hovered=true;
													me.unSelectAll(this);
													$(this).addClass("selected");
												});

												target.mouseout(function(e){
													me.hovered=false;
													$(this).removeClass("selected");
												});

												target.click(function(e){
													me.textField.val($(this).find(".suggestion_title").text());
													if(me.idField!=null){
														me.idField.val($(this).attr("id_field"));
													}

													// Callback function
													if(me.onSelected!=null){
														me.onSelected.call(this, me.arrData[$(this).attr("seq_id")]);
													}

													if(me.submitOnSelect==true){
														$("form").has(me.textField).submit();
													}

													me.hide();
												});
											}

											me.show(me.holder.find("." + suggestItem).height() * arr.length);
										}
										else{
											me.hide();
										}
									}
								}
								catch(e){
									alert('对不起你的手速太快，服务器快跟不上了！');
								}
							},
							error: function(xhr, status, ex){
								alert('对不起你的手速太快，服务器快跟不上了！');
							}
						});
					}
					else{
						me.hide();
					}
				}
				else{
					if(me.holder.css("display")!="none"){
						checkKey(e);
					}
					else{
						// Callback function
						if(me.onSelected!=null){
							me.onSelected.call(this, null);
						}
					}
				}
			}
		);

		this.textField.bind(
			"blur",
			function(e){
				if(me.idField!=null){
					if(me.checkSelected(me.textField.val())==false){
						me.textField.val("");
						me.idField.val("");
					}
				}

				if(me.hovered==false){
					me.hide();
				}
				else{
					me.hovered=false;
				}
			}
		);

		this.show=function(height){
			this.holder.css({
				"position":"absolute",
				"left":this.textField.position().left + "px",
				"top":this.textField.position().top + this.textField.height() + 5 + "px",
				"height":height + "px"
			});

			this.holder.css({
				"width":width + "px"
			});
			//此处可以设置选项的宽度
			this.holder.find("." + suggestItem).css({
				"width":(width) + "px",
				"overflow":"hidden"
			});

			this.holder.show();
		}

		this.hide=function(){
			this.holder.hide();
		}

		this.unSelectAll=function(div){
			var id=$(div).attr("id");
			var rows=this.holder.find("." + suggestItem).get().length;

			for(i=1;i<=rows;i++){
				this.holder.find("#" + suggestRow + i).removeClass("selected");
			}

			currRow=parseInt(id.replace(suggestRow, ""));
			var rgx=/^[0-9]+$/;
			if(!rgx.test(currRow)){
				currRow=0;
			}
		}

		this.setWidth=function(w){
			width=w;
		}

		this.setMinChars=function(c){
			minChars=c;
		}

		this.preventEnter=function(){
			this.textField.keypress(
				function(e){
					if(e.keyCode==13){
						return false;
					}

					return true;
				}
			);
		}

		this.checkSelected=function(data){
			if(this.arrData!=null){
				for(var i=0;i<this.arrData.length;i++){
					if(this.arrData[i].data==data){
						return true;
					}
				}
			}

			return false;
		}

		function checkKey(e){
			if(me.holder.css("display")!="none"){
				var rows=me.holder.find("." + suggestItem).get().length;
				if(e.keyCode==40){
					currRow++;
					if(currRow<=rows){
						if(currRow>0){
							me.holder.find("#" + suggestRow + (currRow-1)).removeClass("selected");
						}

						var target=me.holder.find("#" + suggestRow + currRow);

						target.addClass("selected");
						me.textField.val(target.find(".suggestion_title").text());
						if(me.idField!=null){
							me.idField.val(target.attr("id_field"));
						}
					}
					else{
						currRow=rows;
					}
				}
				else if(e.keyCode==38){
					currRow--;
					if(currRow>0){
						if(currRow<rows){
							me.holder.find("#" + suggestRow + (currRow+1)).removeClass("selected");
						}

						var target=me.holder.find("#" + suggestRow + currRow);

						target.addClass("selected");
						me.textField.val(target.find(".suggestion_title").text());
						if(me.idField!=null){
							me.idField.val(target.attr("id_field"));
						}
					}
					else{
						currRow=1;
					}
				}
				else if(e.keyCode==13){
					if(me.idField!=null){
						if(me.checkSelected(me.textField.val())==false){
							me.textField.val("");
							me.idField.val("");
						}
					}

					// Callback function
					if(me.onSelected!=null){
						if(currRow>0){
							me.onSelected.call(this, me.arrData[currRow-1]);
						}
						else{
							me.onSelected.call(this, null);
						}
					}
					
					me.hide();
				}
			}
			else{
				// Callback function
				if(me.onSelected!=null){
					me.onSelected.call(this, null);
				}
			}

			return true;
		}
	}

	$.fn.coolautosuggest = function(options) {
		var settings = {
			width: null,
			minChars: null,
			idField: null,
			submitOnSelect: false,
			showThumbnail : false,
			showDescription : false,
			onSelected : null
		};
		$.extend(settings, options);

		return this.each(function() {
			var obj = new autosuggest(settings.url, $(this));

			if(settings.width!=null){
				obj.setWidth(settings.width);
			}

			if(settings.minChars!=null){
				obj.setMinChars(settings.minChars);
			}

			if(settings.idField!=null){
				obj.idField=settings.idField;
				obj.preventEnter();
			}

			if(settings.submitOnSelect==true){
				obj.submitOnSelect=true;
			}
			else{
				obj.preventEnter();
			}

			if(settings.showThumbnail==true){
				obj.thumbnail=settings.showThumbnail;
			}

			if(settings.showDescription==true){
				obj.description=settings.showDescription;
			}

			/*if(obj.idField!=null){
				if(obj.checkSelected(obj.textField.val())==false){
					obj.textField.val("");
					obj.idField.val("");
				}
			}*/

			if($.isFunction(settings.onSelected)==true){
				obj.onSelected=settings.onSelected;
			}
		});
	}
})(jQuery);