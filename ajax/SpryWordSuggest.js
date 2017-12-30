// JavaScript Document
var dsSuggestedWords = new Spry.Data.XMLDataSet("xml/autosuggest.xml", "/suggestedwords/item", { sortOnLoad: "word" })

function MyQueryFunc(autoCompleteWidget, str, contains, dataSet, columnName)
{
	// Auto suggest query functions typically fire off a request to
	// a server. Since all of our data is housed in a single file, all
	// we need to do is make sure that we filter it properly.

	if (!str)
	{
		// The auto suggest widget contains no value in its
		// text field. Install a null filter on the data set
		// so the menu empties out, and then hide it so it can't
		// be seen.
		dataSet.filter(function(ds, row, rowNumber) { return null; });
		autoCompleteWidget.showSuggestions(false);
		return;
	}

	// We have a value to auto suggest against. Build a non-destructive
	// filter that uses this value to decide what rows to keep in the
	// data set. Check the "contains" value that was passed in to this
	// function. If it is false, then we'll only match strings that begin
	// with the auto suggest value, otherwise we will match any string
	// that contains the value.

	var regExpStr = Spry.Widget.SimpleAutoSuggest.escapeRegExp(str);
	
	if (!contains)
	 	regExpStr = "^" + regExpStr;

	var regExp = new RegExp(regExpStr, "i");
	
	var filterFunc = function(ds, row, rowNumber)
	{
		var str = row[columnName];
		if (str && str.search(regExp) != -1)
			return row; /* MATCH! */
		return null; /* NO MATCH! */
	};

	dataSet.filter(filterFunc);

	// Now that the data is filtered. Decide if we
	// should show the menu or not.

	autoCompleteWidget.showSuggestions(dataSet.getData().length > 0);
}
-->