<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('shinpan', function(Blueprint $table) {
			$table->foreign('userId')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('shinpan', function(Blueprint $table) {
			$table->foreign('shiaiCategoryId')->references('id')->on('shiaiCategory')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tournament', function(Blueprint $table) {
			$table->foreign('placeId')->references('id')->on('place')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grade')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('countryId')->references('id')->on('country')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('competitor', function(Blueprint $table) {
			$table->foreign('userId')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('competitor', function(Blueprint $table) {
			$table->foreign('shiaiCategoryId')->references('id')->on('shiaiCategory')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('competitor', function(Blueprint $table) {
			$table->foreign('clubId')->references('id')->on('Club')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('fight', function(Blueprint $table) {
			$table->foreign('shiaiCategoryId')->references('id')->on('shiaiCategory')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('team', function(Blueprint $table) {
			$table->foreign('shiaiCategoryId')->references('id')->on('shiaiCategory')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('shiaiCategory', function(Blueprint $table) {
			$table->foreign('tournamentId')->references('id')->on('tournament')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('association', function(Blueprint $table) {
			$table->foreign('adminId')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('club', function(Blueprint $table) {
			$table->foreign('asocId')->references('id')->on('association')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('shinpan', function(Blueprint $table) {
			$table->dropForeign('Shinpan_userId_foreign');
		});
		Schema::table('shinpan', function(Blueprint $table) {
			$table->dropForeign('Shinpan_shiaiCategoryId_foreign');
		});
		Schema::table('tournament', function(Blueprint $table) {
			$table->dropForeign('Tournament_placeId_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('Users_grade_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('Users_countryId_foreign');
		});
		Schema::table('competitor', function(Blueprint $table) {
			$table->dropForeign('Competitor_userId_foreign');
		});
		Schema::table('competitor', function(Blueprint $table) {
			$table->dropForeign('Competitor_shiaiCategoryId_foreign');
		});
		Schema::table('competitor', function(Blueprint $table) {
			$table->dropForeign('Competitor_clubId_foreign');
		});
		Schema::table('fight', function(Blueprint $table) {
			$table->dropForeign('Fight_shiaiCategoryId_foreign');
		});
		Schema::table('team', function(Blueprint $table) {
			$table->dropForeign('Team_shiaiCategoryId_foreign');
		});
		Schema::table('shiaiCategory', function(Blueprint $table) {
			$table->dropForeign('ShiaiCategory_tournamentId_foreign');
		});
		Schema::table('association', function(Blueprint $table) {
			$table->dropForeign('Association_adminId_foreign');
		});
		Schema::table('club', function(Blueprint $table) {
			$table->dropForeign('Club_asocId_foreign');
		});
	}
}