const answerElem = document.getElementById('answer');
if (answerElem != null) {
  const answer = answerElem.value;
  if (answer > 0) {
    alert('正解');
  } else {
    alert('不正解');
  }
}


const routeElem = document.getElementById('route');
if (routeElem != null) {
  location.href = routeElem.value
}
