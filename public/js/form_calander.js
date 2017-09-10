/**
 * Created by pookie on 7/2/17.
 */
function otherweek() {
    var x = document.getElementById('calander1');
    var y = document.getElementById('calander2');

    if (x.style.display === 'none') {
        x.style.display = 'block';
        y.style.display = 'none';
    } else {
        x.style.display = 'none';
        y.style.display = 'block';

    }
}