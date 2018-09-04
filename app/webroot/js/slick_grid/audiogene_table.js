/*******
* Code for displaying the grid and handling edits.
* Note: I have edited the CheckboxSelectColumn
*******/

var grid;

var opened = false;

function requiredFieldValidator(value) {
	if (value == null || value == undefined || !value.length)
		return {valid: false, msg: "This is a required field"};
	else
		return {valid: true, msg: null};
}

function integerValidation(value) {
	if (value == null || value == undefined || !value.length) {
		value = "";
		return {valid: true, msg: null}
	} else
		return {valid: true, msg: null}

}

var checkboxSelector = new Slick.CheckboxSelectColumn({
	cssClass: "slick-cell-checkboxsel",
            //headerCssClass: "hi"
});

var columns = [
	checkboxSelector.getColumnDefinition(),
            //checkboxSelector.getColumnDefinition(),
	{id: "ID", name: "PatientID", field: "id", editor: TextCellEditor, selectable: true},
	//{id: "Age", name: "Age", field: "age", editor: TextCellEditor },
	{id: "Ear", name: "AudiogramID", field: "Ear", editor: SelectCellEditor},
	{id: "125hz", name: "125 Hz", field: "f125", editor: TextCellEditor, width: 70},
	{id: "250hz", name: "250 Hz", field: "f250", editor: TextCellEditor, width: 70},
	{id: "500hz", name: "500 Hz", field: "f500", editor: TextCellEditor, width: 70},
	{id: "1000hz", name: "1 kHz", field: "f1K", editor: TextCellEditor, width: 70},
	{id: "1500hz", name: "1.5 kHz", field: "f15K", editor: TextCellEditor, width: 74},
	{id: "200hz", name: "2 kHz", field: "f2K", editor: TextCellEditor, width: 70},
	{id: "3000hz", name: "3 kHz", field: "f3K", editor: TextCellEditor, width: 70},
	{id: "4000hz", name: "4 kHz", field: "f4K", editor: TextCellEditor, width: 70},
	{id: "6000hz", name: "6 kHz", field: "f6K", editor: TextCellEditor, width: 70},
	{id: "8000hz", name: "8 kHz", field: "f8K", editor: TextCellEditor, width: 70}

];

var options = {
	enableColumnReorder: false,
	editable: true,
	enableCellNavigation: true,
	enableAddRow: false
};

function createGrid() {
	var data = [];

	grid = new Slick.Grid("#myGrid", data, columns, options);

	$("#myGrid").show();
	grid.setSelectionModel(new Slick.RowSelectionModel({selectActiveRow: false}));
	grid.registerPlugin(checkboxSelector);

	grid.onSelectedRowsChanged.subscribe(function() {
		$('#delete-rows').attr('disabled', true)
		var selectedCount = grid.getSelectedRows().length;

		if (selectedCount == 0) {
			$('#delete-rows').attr('disabled', true);
			$('#delete-rows').html('Delete Rows');

			$('#duplicate-row').attr('disabled', true);
		} else {
			$('#delete-rows').html('Delete (' + selectedCount + ') Rows');
			$('#delete-rows').attr('disabled', false);

			if (selectedCount == 1) {
				$('#duplicate-row').attr('disabled', false);
			} else {
				$('#duplicate-row').attr('disabled', true);
			}

		}
	});

	grid.onCellChange.subscribe(function(e, args) {
		if (typeof args == 'undefined')
			return;

		if ((args.cell > 3)) {
			var cellValue = args.item[grid.getColumns()[args.cell].field];
			var numericCellValue = cellValue.replace(/[^0-9\-]/g, '');
			var convertedValue = parseInt(numericCellValue);

			if (cellValue != convertedValue) {
			//Check if NaN, if the value is NaN the this will be true
			if (convertedValue != convertedValue) {
				args.item[grid.getColumns()[args.cell].field] = "";
			} else {
				if (convertedValue < -20) {
					convertedValue = "";
				} else if (convertedValue > 130) {
					convertedValue = 130;
				}
				args.item[grid.getColumns()[args.cell].field] = convertedValue;
			}
			grid.invalidateRow(args.row);
			grid.render();

			} else if (convertedValue < -20) {
				convertedValue = "";
				args.item[grid.getColumns()[args.cell].field] = convertedValue;
				grid.invalidateRow(args.row);
				grid.render();
			} else if (convertedValue > 130) {
				convertedValue = 130;
				args.item[grid.getColumns()[args.cell].field] = convertedValue;
				grid.invalidateRow(args.row);
				grid.render();
			}


		} //else if (args.cell == 2) {
			/* Check if age is a number */
		/*	var cellValue = args.item[grid.getColumns()[args.cell].field];
			var numericCellValue = cellValue.replace(/[^0-9\.]/g, '');
			var convertedValue = parseFloat(numericCellValue);

			if (cellValue != convertedValue) {
				//Check if NaN, if the value is NaN the this will be true
				if (convertedValue != convertedValue) {
					args.item[grid.getColumns()[args.cell].field] = "";
				} else {
					args.item[grid.getColumns()[args.cell].field] = convertedValue;
				}
				grid.invalidateRow(args.row);
				grid.render();

			}
		}*/

	});

};

function SelectCellEditor (args) {
	var $select;
	var defaultValue;
	var scope = this;

	this.init = function() {

		if (args.column.options){
			opt_values = args.column.options.split(',');
		} else {
			opt_values ="Combined,Left,Right".split(',');
		}
		option_str = ""
		for (i in opt_values){
			v = opt_values[i];
			option_str += "<OPTION value='" + v + "'>" + v + "</OPTION>";
		}
		$select = $("<SELECT tabIndex='0' class='editor-select'>" + option_str + "</SELECT>");
		$select.appendTo(args.container);
		$select.focus();
	};

	this.destroy = function() {
		$select.remove();
	};

	this.focus = function() {
		$select.focus();
	};

	this.loadValue = function(item) {
		defaultValue = item[args.column.field];
		$select.val(defaultValue);
	};

	this.serializeValue = function() {
		return $select.val();
	};

	this.applyValue = function(item, state) {
		item[args.column.field] = state;
	};

	this.isValueChanged = function() {
		return ($select.val() != defaultValue);
	};

	this.validate = function() {
		return {
			valid: true,
			msg: null
		};
	};

	this.init();
}

$(document).ready(function() {

	$('#AudiogramIndexForm').submit(function() {
		grid.getEditorLock().commitCurrentEdit();
		if ($("#edit-step").val() > 2)
			return true;

		if ($("[name='data[Audiogram][input_type]']:checked").val() == "F") {
			return true;
		} else {
			errorList = "";

			if (!$("#AudiogramEmail").val()) {
				$("#AudiogramEmail").addClass("error");
				alert("Please enter a valid Email Address.");
				return false;
			}

			if (isGridValid()) {
				$('#AudiogramCsvData').val(convertGridToCSV());
				return true;
			} else {
				alert("It appears that you have entered in multiple rows with the same ID, Age, and Ear.  Either change the ID, Age or Ear to make these rows unique.");
				return false;
			}

		}
	});


	if ($("[name='data[Audiogram][input_type]']:checked").val() == "S") {
		$("#spreadsheet-group").show();
		$("#file-upload").hide();
		if (opened == false) {
			createGrid();
			opened = true;
		}
	}



	$("#add-new-row").click(function(){
		grid.getEditorLock().commitCurrentEdit();
		var data = grid.getData();
		data.push({
			id: "",
		//	age: "",
			Ear: "",
			f125: "",
			f250: "",
			f500: "",
			f1K: "",
			f15K: "",
			f2K: "",
			f3K: "",
			f4K: "",
			f6K: "",
			f8K: "",
		});
		grid.setData(data);
		grid.render();
	});



	$("#delete-rows").click(function(){
		grid.getEditorLock().commitCurrentEdit();
		var selectedRows = grid.getSelectedRows().sort().reverse();
		var data = grid.getData();

		//We want to delete the highest row first
		//so it doesn't change the index of the lower ones
		//to be deleted
		for (var i = 0; i < selectedRows.length; i++) {
			grid.invalidateRow(selectedRows[i]);
			data.splice(selectedRows[i], 1);
		}
		grid.setData(data);
		grid.render();

		grid.invalidateAllRows();
		grid.render();

		$('#delete-rows').attr('disabled', true);
		$('#delete-rows').html('Delete Rows');
		grid.setSelectedRows([]);

	});

	$("#duplicate-row").click(function(){
		grid.getEditorLock().commitCurrentEdit();
		var selectedRow = grid.getSelectedRows()[0];
		var data = grid.getData();

		//We want to delete the highest row first
		//so it doesn't change the index of the lower ones
		//to be deleted

		var rowData = data[selectedRow];
		copiedRowData = $.extend({}, rowData);
		data.splice(selectedRow, 0, copiedRowData);

		grid.setData(data);
		grid.render();

		grid.invalidateAllRows();
		grid.render();
		grid.setSelectedRows([]);
		$('#delete-rows').attr('disabled', true);
		$('#delete-rows').html('Delete Rows');


	});


	$("#load-demo-data").click(function(){
		loadDemoData();
	});

	//Gray out delete button
	$('#delete-rows').attr('disabled', true);
	$('#duplicate-row').attr('disabled', true);


	$("[name='data[Audiogram][input_type]']").click(function() {
		var value = $(this).attr("value")
		if (value == "F") {
			$("#spreadsheet-group").hide("slow");
			$("#file-upload").show("slow");
		} else if (value == "S") {
			$("#spreadsheet-group").show("slow");
			$("#file-upload").hide("slow");
			if (opened == false) {
				createGrid();
				opened = true;
			}

		}
	});


});

function isGridValid() {

	var data = grid.getData();
	var valid = true;
	//Check for non-unique rows
	var hash = [];
	for (var i = 0; i < data.length; i++) {

		var id = data[i].id;
		var age = data[i].age;
		var ear = data[i].Ear;

		if (id.length  && ear.length) {
			if (hash[id + "-" + ear] == undefined) {
				hash[id + "-" + ear] = i;

			} else {
				valid = false;
			}
		}

	}

	return valid;

}

function convertGridToCSV() {
	var csv = "ID,Ear-LR,125 dB,250 dB,500 dB,1000 dB,1500 dB,2000 dB,3000 dB,4000 dB,6000 dB,8000 dB\n";
	var data = grid.getData();
	for (var i = 0; i < data.length; i++) {
		if (i > 0) csv += "\n";
		csv += convertToCSVRow(data[i]);
	}
	return csv;
}

function convertToCSVRow(row) {
            var line;
            //= "null,null,unknown,";

	/*var lineId = row.id;

	if (!isNaN(row.id[0])) {
		lineId = "_" + lineId;
	}

	line += lineId.replace(",","__COMMA__") + ",";*/

	//line += row.age + ",";
	//line += "M,";
            line += row.id + ",";
	line += row.Ear + ",";
	line += row.f125 + ",";
	line += row.f250 + ",";
	line += row.f500 + ",";
	line += row.f1K + ",";
	line += row.f15K + ",";
	line += row.f2K + ",";
	line += row.f3K + ",";
	line += row.f4K + ",";
	line += row.f6K + ",";
	line += row.f8K;

	return line;
}

function loadDemoData() {
	var data = [];
	for (var i = 0; i < 5; i++) {
		data[i] = {
			id: "Name " + i,
			//age: Math.round(Math.random() * 50),
                                    Ear: (Math.random() <= .5 ? "Left": "Right"),
			f125: Math.round(Math.random() * 100),
			f250: Math.round(Math.random() * 100),
			f500: (Math.random() <= .75 ? Math.round(Math.random() * 100) : ""),
			f1K: Math.round(Math.random() * 100),
			f15K: (Math.random() <= .75 ? Math.round(Math.random() * 100) : ""),
			f2K: Math.round(Math.random() * 100),
			f3K: Math.round(Math.random() * 100),
			f4K: (Math.random() <= .75 ? Math.round(Math.random() * 100) : ""),
			f6K: Math.round(Math.random() * 100),
			f8K: (Math.random() <= .75 ? Math.round(Math.random() * 100) : ""),
		};
	}

	grid.setData(data);
	grid.setSelectedRows([]);
	grid.invalidateAllRows();
	grid.render();

}

function loadSpreadsheetData()
{
	var lines = $("#AudiogramCsvData").val().split("\n");
	var data = [];
	for (var i = 1; i < lines.length; i++) {

		var parts = lines[i].split(",");
		data[i-1] = [];
		for (var j = 1; j < grid.getColumns().length; j++) {
			data[i-1][grid.getColumns()[j].field] = (j > 2 ? parts[j + 3] : parts[j + 2]);
		}
	}

	grid.setData(data);
	grid.setSelectedRows([]);
	grid.invalidateAllRows();
	grid.render();

}
