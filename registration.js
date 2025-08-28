window.onload = function() {
    const countElement = document.getElementById('count');

    function adjustChildRows() {
        const count = countElement.value;
        for (let i = 1; ; i++) {
            const row = document.getElementById('row_' + i);
            if (row) {
                row.style.display = (i <= count) ? 'table-row' : 'none';
            }
            else {
                break;
            }
	    const rowComments = document.getElementById('row_' + i + 'a');
            if (rowComments) {
                rowComments.style.display = (i <= count) ? 'table-row' : 'none';
            }
        }
    };

    /* Adjust visible number of rows in the table of children,
       now (when form is first loaded) and whenever the number
       of children changes.
    */

    adjustChildRows();
    countElement.addEventListener('change', adjustChildRows);
};
