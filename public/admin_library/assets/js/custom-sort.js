
function sortTable(column, me) {
    var table = $(me).parents('table').eq(0),
      rows = table.find('tr:gt(0)').toArray().sort(doComparer($(this).index()))
    me.asc = !me.asc
    if (!me.asc) {
      rows = rows.reverse()
    }
  
    for (var i = 0; i < rows.length; i++) {
      table.append(rows[i])
    }
}
  
function doComparer(index) {
    return function(a, b) {
        a = getCellValue(a, index);
        b = getCellValue(b, index);
        return $.isNumeric(a) && $.isNumeric(b) ? a - b : a.toString().localeCompare(b)
    }
}
  
function getCellValue(row, index) {
    return $(row).children('td').eq(index).text()
}