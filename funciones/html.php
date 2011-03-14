<?php
	function reorganize_data($items)
	{
		// Collect rows and columns
		$rows = array();
		$columns = array();

		// Loop through each of the items
		foreach ($items as $item)
		{
			// Let's append to a new row
			$row = array();
			$row['id'] = (string) $item->Name;

			// Loop through the item's attributes
			foreach ($item->Attribute as $attribute)
			{
				// Store the column name
				$column_name = (string) $attribute->Name;

				// If it doesn't exist yet, create it.
				if (!isset($row[$column_name]))
				{
					$row[$column_name] = array();
				}

				// Append the new value to any existing values
				// (Remember: Entries can have multiple values)
				$row[$column_name][] = (string) $attribute->Value;
				natcasesort($row[$column_name]);

				// If we've not yet collected this column name, add it.
				if (!in_array($column_name, $columns, true))
				{
					$columns[] = $column_name;
				}
			}

			// Append the row we created to the list of rows
			$rows[] = $row;
		}

		// Return both
		return array(
			'columns' => $columns,
			'rows' => $rows,
		);
	}

	function generate_html_table($data)
	{
		// Retrieve row/column data
		$columns = $data['columns'];
		$rows = $data['rows'];

		// Generate shell of HTML table
		$output = '<table cellpadding="0" cellspacing="0" border="0">' . PHP_EOL;
		$output .= '<thead>';
		$output .= '<tr>';
		$output .= '<th></th>'; // Corner of the table headers

		// Add the table headers
		foreach ($columns as $column)
		{
			$output .= '<th>' . $column . '</th>';
		}

		// Finish the <thead> tag
		$output .= '</tr>';
		$output .= '</thead>' . PHP_EOL;
		$output .= '<tbody>';

		// Loop through the rows
		foreach ($rows as $row)
		{
			// Display the item name as a header
			$output .= '<tr>' . PHP_EOL;
			$output .= '<th>' . $row['id'] . '</th>';

			// Pull out the data, in column order
			foreach ($columns as $column)
			{
				// If we have a value, concatenate the values into a string. Otherwise, nothing.
				$output .= '<td>' . (isset($row[$column]) ? implode(', ', $row[$column]) : '') . '</td>';
			}

			$output .= '</tr>' . PHP_EOL;
		}

		// Close out our table
		$output .= '</tbody>';
		$output .= '</table>';

		return $output;
	}


        function generate_html_table2($data,$nombre,$item)
	{
		// Retrieve row/column data
		$columns = $data['columns'];
		$rows = $data['rows'];
             
		// Generate shell of HTML table
                $output  = "<form action=\"dominios.php?nombre=$nombre\" method=\"POST\">";
                $output .= '<input type="hidden" name="item" value="'.$item.'">';
                $output .= '<input type="hidden" name="nombre" value="'.$nombre.'">';
		$output .= '<table cellpadding="0" cellspacing="0" border="0">' . PHP_EOL;
		$output .= '<thead>';
		$output .= '<tr>';
		$output .= '<th></th>'; // Corner of the table headers
                $i=0;
                $o=0;
                $total=0;
                $prueba = array();
		// Add the table headers
		foreach ($columns as $column)
		{
			$output .= '<th>' . $column . '</th>';
		}
                        $output .= '<th>Enviar</th>';
		// Finish the <thead> tag
		$output .= '</tr>';
		$output .= '</thead>' . PHP_EOL;
		$output .= '<tbody>';
               
		// Loop through the rows
		foreach ($rows as $row)
		{
			// Display the item name as a header
			$output .= '<tr>' . PHP_EOL;
			$output .= '<th>' . $row['id'] . '</th>';
                        

			// Pull out the data, in column order
                        $i=0;
                        $o=0;
                        $total=$total+1;
			foreach ($columns as $column)
			{
                                $texto = (isset($row[$column]) ? implode(', ', $row[$column]) : '');
                                $par[$i]=$texto;
                                $par[$i][$o]=$column;
				// If we have a value, concatenate the values into a string. Otherwise, nothing.
				$output .= '<td><input type=text name='.$column.' value='.$texto.'  ><p align="center"><input name="" type="button" onclick="location.href = \'eliminar-atributo.php?item='.$item.'&nombre='.$nombre.'&atributo='.$column.'&valor='.$texto.'\'" value="Eliminar" /></p></td>';
                                //$output .= '<input type="hidden" name='.$par[$i][$o].' value='.$column.'>';
                                $i++;
                                $o++;
			}
                                $output .= '<td><p align="center"><input name="go2" type="submit" value="go!" /><br><input name="add" type="button" onclick="location.href = \'anadir-atributo.php?item='.$item.'&nombre='.$nombre.'\'" value="add" /><br><input name="eliminar" type="button" onclick="location.href = \'eliminar-item.php?item='.$item.'&nombre='.$nombre.'\'" value="Eliminar" /></td></p>';
                                $output .= '</tr>' . PHP_EOL;
		}

		// Close out our table
		$output .= '</tbody>';
		$output .= '</table>';
                $output .= '</form>';
		return $output;
	}
?>
