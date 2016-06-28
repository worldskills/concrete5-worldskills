var worldskillsMemberList = {
  init: function() {
    this.toolsDir = $('input[name=worldskillsMemberListToolsDir]').val();
    this.selectParentId = $('select[name=parentId]');
    this.btnSyncPages = $('input[name=worldskillsMemberListSyncPages]');
    this.status = $('#worldskillsMemberListStatus');
    this.btnSyncPages.click(function () {
      worldskillsMemberList.btnSyncPages.attr('disabled', 'disabled');
      worldskillsMemberList.btnSyncPages.val('Syncing pages...');
      worldskillsMemberList.syncPages();
    });
  },
  syncPages: function() {
    var bID = $('input[name=worldskillsMemberListbID]').val();
    $.post(worldskillsMemberList.toolsDir + 'sync_pages', {bID: bID}, function (response) {
      worldskillsMemberList.status.text(response.members.length + '/' + response.total_count + ' pages synced');
      worldskillsMemberList.btnSyncPages.val('Synchronize pages');
      worldskillsMemberList.btnSyncPages.removeAttr('disabled');
    });
  }
}
Concrete.event.bind('worldskillsmemberlist.edit.open', function() {
  worldskillsMemberList.init();
});
