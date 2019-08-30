<template>
  <input type="text" 
         id="keywords" 
         name="keywords" 
         class="form-control" 
         placeholder="Search Topics"
         :value="initialValue">
</template>

<script>
import AlgoliaSearch from 'algoliasearch';
import autocomplete from 'autocomplete.js';

export default {
  props: ['initialValue'],
  mounted() {
    let client = AlgoliaSearch('JGHPOXGN3H', 'e55c67b9b81853935a3431847f397e47');
    let index = client.initIndex('topics');
    autocomplete('#keywords', { hint: false }, [
      {
        source: autocomplete.sources.hits(index, { hitsPerPage: 5 }),
        displayKey: 'title',
        templates: {
          suggestion: function(suggestion) {
            return suggestion._highlightResult.title.value;
          }
        }
      }
    ]);      
  }
}
</script>
<style>
.algolia-autocomplete {
  width: 100%;
}
.algolia-autocomplete .aa-input, .algolia-autocomplete .aa-hint {
  width: 100%;
}
.algolia-autocomplete .aa-hint {
  color: #999;
}
.algolia-autocomplete .aa-dropdown-menu {
  color: #fff;
  width: 100%;
  background-color: #324447;
  border: 1px solid #999;
  border-top: none;
}
.algolia-autocomplete .aa-dropdown-menu .aa-suggestion {
  cursor: pointer;
  padding: 5px 4px;
}
.algolia-autocomplete .aa-dropdown-menu .aa-suggestion.aa-cursor {
  background-color: #B2D7FF;
  color: #000;
}
.algolia-autocomplete .aa-dropdown-menu .aa-suggestion em {
  font-weight: bold;
  font-style: normal;
  color: #FF8C00;
}
</style>
