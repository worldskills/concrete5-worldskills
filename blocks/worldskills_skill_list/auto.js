var worldskillsSkillList = {
  init: function() {
    this.apiUrl = $('input[name=worldskillsSkillListApiUrl]').val();
    this.toolsDir = $('input[name=worldskillsSkillListToolsDir]').val();
    this.sectorId = $('input[name=worldskillsSkillListSectorId]').val();
    this.selectEventId = $('select[name=eventId]');
    this.selectEventId.change(function () {
      worldskillsSkillList.loadSectors();
    });
    this.selectSectorId = $('select[name=sectorId]');
    this.loadSectors();
    this.btnSyncPages = $('input[name=worldskillsSkillListSyncPages]');
    this.status = $('#worldskillsSkillListStatus');
    this.btnSyncPages.click(function () {
      worldskillsSkillList.btnSyncPages.attr('disabled', 'disabled');
      worldskillsSkillList.btnSyncPages.val('Syncing pages...');
      worldskillsSkillList.syncPages();
    });
  },
  loadSectors: function() {
    var eventId = worldskillsSkillList.selectEventId.val();
    worldskillsSkillList.selectSectorId.empty();
    worldskillsSkillList.selectSectorId.append('<option>Loading sectors...</option>');
    if (eventId) {
      $.get(worldskillsSkillList.apiUrl + '/events/' + eventId + '/sectors', {limit: 100}, function (response) {
        worldskillsSkillList.selectSectorId.empty();
        worldskillsSkillList.selectSectorId.append('<option></option>');
        $.each(response.sectors, function (i, sector) {
          var option = $('<option/>');
          option.attr('value', sector.id);
          option.text(sector.name.text);
          if (worldskillsSkillList.sectorId == sector.id) {
            option.attr('selected', 'selected');
          }
          worldskillsSkillList.selectSectorId.append(option)
        });
      });
    }
  },
  syncPages: function() {
    var bID = $('input[name=worldskillsSkillListbID]').val();
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
