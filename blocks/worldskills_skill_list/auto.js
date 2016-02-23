var worldskillsSkillList = {
  init: function() {
    this.toolsDir = $('input[name=worldskillsSkillListToolsDir]').val();
    this.btnSyncPages = $('input[name=worldskillsSkillListSyncPages]');
    this.status = $('#worldskillsSkillListStatus');
    this.btnSyncPages.click(function () {
      worldskillsSkillList.btnSyncPages.attr('disabled', 'disabled');
      worldskillsSkillList.btnSyncPages.val('Syncing pages...');
      worldskillsSkillList.syncPages();
    });
  },
  syncPages: function() {
    var bID = $('input[name=bID]').val();
    $.post(worldskillsSkillList.toolsDir + 'sync_pages', {bID: bID}, function (response) {
      worldskillsSkillList.status.text(response.skills.length + '/' + response.total_count + ' pages synced');
      worldskillsSkillList.btnSyncPages.val('Synchronize pages');
      worldskillsSkillList.btnSyncPages.removeAttr('disabled');
    });
  }
}
Concrete.event.bind('worldskillsskilllist.edit.open', function() {
  worldskillsSkillList.init();
});
