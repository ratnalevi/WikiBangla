
function loadSubCategory(id){
	jQuery.ajax({
		url: base_url + 'admin/loadSubCategory/'+id,
		type: 'GET',
		success: function(data) 
		{	
			$('#sub_category_id').empty(); 
			$('#sub_category_id').append(data);						
		},
	});
}

function addRowImage(){
	rowCount = $('#multi_image .new_row').length;
	$('#multi_image').append('<div class="form-group new_row" id="'+rowCount+'"><label class="col-sm-3 control-label">Image</label><div class="col-sm-7 padding-top-5"><input type="file" name="filename[]"/></div></div>'); 		
}
function addRowVideo(){
	rowCount = $('#multi_video .new_video').length;
	$('#multi_video').append('<div class="form-group new_video" id="'+rowCount+'"><label class="col-sm-4 control-label">Embed (Youtube)</label><div class="col-sm-8"><input type="text" name="link[]" class="form-control"/></div></div>'); 		
}


function loadPart(post_id){
	jQuery.ajax({
		url: base_url + 'ajax/loadPart/'+post_id,
		type: 'GET',
		success: function(data) 
		{	 
			$('#loadPart').append(data);	
			$('#loadPartButton').addClass('hide');						
		},
	});
}

function loadSection(part_id){
	var rowCount = $('#load_section_'+part_id+' .panel').length;
	rowCount = rowCount+1;
	jQuery.ajax({
		url: base_url + 'ajax/loadSection/'+part_id+'/'+rowCount,
		type: 'GET',
		success: function(data) 
		{	 
			$('#load_section_'+part_id).append(data);					
		},
	});
}

function deleteSection(section_id){
	var r = confirm("Are you sure delete this section?");
	if (r == true) {
		jQuery.ajax({
			url: base_url + 'ajax/deleteSection/'+section_id,
			type: 'GET',
			success: function(data) 
			{	 
				$('#delete_section_'+section_id).remove();					
			},
		});
	}
}
function deletePart(part_id){
	var r = confirm("Are you sure delete this part?");
	if (r == true) {
		jQuery.ajax({
			url: base_url + 'ajax/deletePart/'+part_id,
			type: 'GET',
			success: function(data) 
			{	 
				$('#delete_part_'+part_id).remove();					
			},
		});
	}
}

function loadSummary(){
	var rowCount = $('#loadSummary tr:last-child').attr('class');
	
	if(rowCount==undefined){
		var rowCount = 0;
	}else{
		var rowCount = Number(rowCount)+1;
	}
	$('#loadSummary').append('<tr class="'+rowCount+'"><td><input onclick="deleteSummary('+rowCount+');" type="button" class="btn btn-info btn-xs" value="Delete"/></td><td><input type="text" name="label[]" class="form-control" value="" required=""/></td><td><input type="text" name="description[]" class="form-control" value="" required=""/></td></tr>'); 		
}
function deleteSummary(i){	
	$('#loadSummary .'+i).remove();
}

function slugTitle(val){
	slug = val.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
	$('#slug').val('');
	$('#slug').val(slug);
}
function slugBanglaTitle(val){
	slug = val.replace(/[_\s]/g, '-').replace("?", '');
	$('#slug_b').val('');
	$('#slug_b').val(slug);
}

function checkCategorySlug(cat_id='')
{	 
	var slug = $('#slug').val();
	var slug_b = $('#slug_b').val();
    var html = $.ajax({
        async: false,
        url: base_url + 'ajax/checkCategorySlug?cat_id=' + cat_id + '&slug=' + slug + '&slug_b=' + slug_b,
        type: 'POST',
        dataType: 'html',
        //data: {'pnr': a},
        timeout: 2000,
    }).responseText;
    if(html == 1){
		$('#infoMessage').empty();
        $('#infoMessage').append('<div class="alert alert-warning" role="alert">Warning! url slug exit.</div>');
        return false;
	}else{
		return true;
    }    
}

function checkPostSlug(post_id='')
{	 
	var slug = $('#slug').val();
	var slug_b = $('#slug_b').val();
    var html = $.ajax({
        async: false,
        url: base_url + 'ajax/checkPostSlug?post_id=' + post_id + '&slug=' + slug + '&slug_b=' + slug_b,
        type: 'POST',
        dataType: 'html',
        //data: {'pnr': a},
        timeout: 2000,
    }).responseText;
    if(html == 1){
		$('#infoMessage').empty();
        $('#infoMessage').append('<div class="alert alert-warning" role="alert">Warning! url slug exit.</div>');
        return false;
	}else{
		return true;
    }    
}