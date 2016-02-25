var worldskillsPeople = {
  init: function() {
    this.apiUrl = $('input[name=worldskillsPeopleApiUrl]').val();
    this.skillId = $('input[name=worldskillsPeopleSkillId]').val();
    this.selectEventId = $('select[name=eventId]');
    this.selectEventId.change(function () {
      worldskillsPeople.loadSkills();
    });
    this.selectSkillId = $('select[name=skillId]');
    this.loadSkills();
  },
  loadSkills: function() {
    var eventId = worldskillsPeople.selectEventId.val();
    worldskillsPeople.selectSkillId.empty();
    worldskillsPeople.selectSkillId.append('<option>Loading skills...</option>');
    if (eventId) {
      $.get(worldskillsPeople.apiUrl + '/events/' + eventId + '/skills', {limit: 100}, function (response) {
        worldskillsPeople.selectSkillId.empty();
        worldskillsPeople.selectSkillId.removeAttr('disabled');
        worldskillsPeople.selectSkillId.append('<option></option>');
        $.each(response.skills, function (i, skill) {
          var option = $('<option/>');
          option.attr('value', skill.id);
          option.text(skill.name.text);
          if (worldskillsPeople.skillId == skill.id) {
            option.attr('selected', 'selected');
          }
          worldskillsPeople.selectSkillId.append(option)
        });
      });
    }
  }
}
Concrete.event.bind('worldskillspeople.edit.open', function() {
  worldskillsPeople.init();
});
