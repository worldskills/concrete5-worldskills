var worldskillsSkill = {
  init: function() {
    this.worldskillsSkillApiUrl = $('input[name=worldskillsSkillApiUrl]').val();
    this.worldskillsSkillId = $('input[name=worldskillsSkillId]').val();
    this.selectEventId = $('select[name=eventId]');
    this.selectEventId.change(function () {
      worldskillsSkill.loadSkills();
    });
    this.selectSkillId = $('select[name=skillId]');
    this.loadSkills();
  },
  loadSkills: function() {
    var eventId = worldskillsSkill.selectEventId.val();
    worldskillsSkill.selectSkillId.find('option').text("Loading skills...");
    if (eventId) {
      $.get(worldskillsSkill.worldskillsSkillApiUrl + '/events/' + eventId + '/skills', {limit: 100}, function (response) {
        worldskillsSkill.selectSkillId.empty();
        worldskillsSkill.selectSkillId.removeAttr('disabled');
        $.each(response.skills, function (i, skill) {
          var option = $('<option/>');
          option.attr('value', skill.id);
          option.text(skill.name.text);
          if (worldskillsSkill.worldskillsSkillId == skill.id) {
            option.attr('selected', 'selected');
          }
          worldskillsSkill.selectSkillId.append(option)
        });
      });
    }
  }
}
Concrete.event.bind('worldskillsskill.edit.open', function() {
  worldskillsSkill.init();
});
