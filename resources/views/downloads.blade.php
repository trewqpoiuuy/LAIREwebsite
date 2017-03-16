@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Downloads</h1>
                </div>

                <div class="panel-body">
               		<div class="list-group">
						<a href="/files/Rulebook.pdf" class="list-group-item">
							<table>
								<tr>
								    <td>
							    		<span class="downArrow align-right">↓</span>
							    	</td>
							    	<td>
								    	<h4>3rd Edition Rulebook</h4>
								    	<p>
								    	The complete 3rd Edition Rulebook for LAIRE
								    	</p>
								    </td>
							    </tr>
							</table>
						</a>
						<a href="/files/New-Player-Guidebook.pdf" class="list-group-item">
							<table>
								<tr>
								    <td>
							    		<span class="downArrow align-right">↓</span>
							    	</td>
							    	<td>
								    	<h4>New Player Guidebook</h4>
								    	<p>
								    	A guidebook aimed at newer players. Features more in-depth information about character creation, with fewer complexities than the core rulebook.
								    	</p>
								    </td>
							    </tr>
							</table>
						</a>
						<a href="/files/New-Player-Reference.pdf" class="list-group-item">
							<table>
								<tr>
								    <td>
							    		<span class="downArrow align-right">↓</span>
							    	</td>
							    	<td>
								    	<h4 >Quick Reference</h4>
								    	<p>
								    	A 5 page reference guide to the most important rules.
								    	</p>
								    </td>
							    </tr>
							</table>
						</a>
						<a href="/files/LAIRECharacterHistoryForm.doc" class="list-group-item">
							<table>
								<tr>
								    <td>
							    		<span class="downArrow align-right">↓</span>
							    	</td>
							    	<td>
								    	<h4>Character History Form</h4>
								    	<p>
								    	It is strongly advised you read Chapter 2 of the rulebook and the new player quick reference guide if it is your first time submitting a character history. Character histories must be approved by our plot committee. If you have questions please contact the plot committee.
									    </p>
								    </td>
							    </tr>
							</table>
						</a>
						</div>
					</div>
						  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection