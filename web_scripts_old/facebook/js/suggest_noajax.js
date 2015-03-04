var SuggestNoAjax = function(rootEl, q, formEl, textBoxEl, idEl, successHandler, instructions, suggestNames, suggestIDs, suggestLocs, placeholderText, defaultOptions, showNoMatches)
{
  this.onInputChange = function()
  {
    if(oThis.typeAheadObj.displaySuggestList(oThis.suggestNames, oThis.suggestIDs, oThis.suggestLocs))
    {
      oThis.typeAheadObj.onListChange();
    }
  }

  this.updateSuggestLists = function(suggestNames, suggestIDs, suggestLocs)
  {
    oThis.suggestNames = suggestNames;
    oThis.suggestIDs = suggestIDs;
    oThis.suggestLocs = suggestLocs;
    //oThis.typeAheadObj.onListChange();
  }

  this.init = function()
  {
    if(!instructions)
    {
      instructions = "Type to select a network";
    }

    if(!defaultOptions)
    {
   //   defaultOptions = {"All of Facebook": -1};
    }
    else
    {
    //  defaultOptions['All of Facebook'] = -1;
    }

    oThis.typeAheadObj = new TypeAhead(rootEl, formEl, textBoxEl, idEl, defaultOptions, instructions, 1, successHandler, this.onInputChange, null, null, null, placeholderText, showNoMatches);
    oThis.typeAheadObj.setText(q);
  }

  this.suggestNames = suggestNames;
  this.suggestIDs = suggestIDs;
  this.suggestLocs = suggestLocs;
  var oThis = this;
  this.init();
}

function debug(str)
{
  document.getElementById("debug").innerHTML += str + "<BR>";
}
