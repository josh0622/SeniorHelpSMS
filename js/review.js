
function starmark(item){
  var count=item.id[0]
  var subid=item.id.substring(1);
  for(var i=0;i<5;i++)
  {
    if(i<count)
    {
      document.getElementById((i+1)+subid).style.color="orange";
    }else {
      document.getElementById((i+1)+subid).style.color="black";
    }
  }
}

function myFunction(){
  var x = document.getElementById('reviewTable');
  x.style.display = "block";
}

// opens the modal when update button is clicked
$(document).on('click', '.openSub', function () {
  $('#modelWindow').modal('show');
});

$(document).on('click', '.openSub2', function () {
  $('#modelWindow2').modal('show');
});

var table = document.getElementById('reviewTable');
for(var i = 1; i < table.rows.length; i++){
  table.rows[i].onclick=function(){
    document.getElementById("rid").value = this.cells[0].innerHTML;
  };
}

  function setModalMaxHeight(element) {
  this.$element     = $(element);
  this.$content     = this.$element.find('.modal-content');
  var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
  var dialogMargin  = $(window).width() < 768 ? 20 : 60;
  var contentHeight = $(window).height() - (dialogMargin + borderWidth);
  var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
  var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
  var maxHeight     = contentHeight - (headerHeight + footerHeight);

  this.$content.css({
    'overflow': 'hidden'
  });

  this.$element
  .find('.modal-body').css({
    'max-height': maxHeight,
    'overflow-y': 'auto'
  });
}

$('.modal').on('show.bs.modal', function() {
  $(this).show();
  setModalMaxHeight(this);
});

$(window).resize(function() {
  if ($('.modal.in').length != 0) {
    setModalMaxHeight($('.modal.in'));
  }
});
