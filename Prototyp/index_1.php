<?php
require_once( "sparql_lib.php" );
echo "part 1";
$db = sparql_connect( "http://localhost:3030/" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
echo "part 2";
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
sparql_ns("schema", "https://schema.org/" );
sparql_ns("rdf", "http://www.w3.org/1999/02/22-rdf-syntax-ns#" );
sparql_ns("rdfs", "http://www.w3.org/2000/01/rdf-schema#" );
sparql_ns("owl", "http://www.w3.org/2002/07/owl#" );
sparql_ns("skos", "http://www.w3.org/2004/02/skos/core#" );
sparql_ns("xsd", "http://www.w3.org/2001/XMLSchema#" );
sparql_ns("wd", "http://www.wikidata.org/entity/" );
sparql_ns("dc", "http://purl.org/dc/elements/1.1/" );
sparql_ns("voaf", "http://purl.org/vocommons/voaf#" );
sparql_ns("vann", "http://purl.org/vocab/vann/" );
sparql_ns("unip", "https://bmake.th-brandenburg.de/unip/" );
echo "part 1";
$sparql = "SELECT * WHERE { ?CollegeOrUniversity a schema:CollegeOrUniversity. } ORDER BY (?CollegeOrUniversity) LIMIT 50";
$result = sparql_query( $sparql ); 
echo "part 3";
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
$fields = sparql_field_array( $result );
echo "part 4";
print "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
print "<table class='example_table'>";
print "<tr>";
foreach( $fields as $field )
{
	print "<th>$field</th>";
}
print "</tr>";
while( $row = sparql_fetch_array( $result ) )
{
	print "<tr>";
	foreach( $fields as $field )
	{
		print "<td>$row[$field]</td>";
	}
	print "</tr>";
}
print "</table>";