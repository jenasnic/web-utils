import '../styles/skyrim.scss';

const initListAction = (id, type) => {
  const select = document.getElementById(id);
  if (!select) {
    return;
  }

  select.addEventListener('change', () => {
    if (select.value) {
      reloadAlchemyContent(type, select.value);
    }
  });
};

initListAction('skyrim-ingredient-list', 'ingredient');
initListAction('skyrim-effect-list', 'effect');

const reloadAlchemyContent = (type, id) => {
  const result = document.getElementById('alchemy-result');

  if (!result) {
    return;
  }

  const action = '/skyrim/ajax/' + type + '/' + id;
  fetch(action, {method: 'GET'})
    .then(response => {
      response.text().then(html => {
        result.innerHTML = html;
      })
    })
    .catch(() => {
      result.innerHTML = '';
    })
  ;
}
