<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('Shinpan', function(Blueprint $table) {
			$table->foreign('userId')->references('id')->on('Users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Shinpan', function(Blueprint $table) {
			$table->foreign('shiaiCategoryId')->references('id')->on('ShiaiCategory')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Tournament', function(Blueprint $table) {
			$table->foreign('placeId')->references('id')->on('Place')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Users', function(Blueprint $table) {
			$table->foreign('gradeId')->references('id')->on('Grade')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Users', function(Blueprint $table) {
			$table->foreign('countryId')->references('id')->on('Country')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Competitor', function(Blueprint $table) {
			$table->foreign('userId')->references('id')->on('Users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Competitor', function(Blueprint $table) {
			$table->foreign('shiaiCategoryId')->references('id')->on('ShiaiCategory')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Competitor', function(Blueprint $table) {
			$table->foreign('clubId')->references('id')->on('Club')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Fight', function(Blueprint $table) {
			$table->foreign('shiaiCategoryId')->references('id')->on('ShiaiCategory')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Team', function(Blueprint $table) {
			$table->foreign('shiaiCategoryId')->references('id')->on('ShiaiCategory')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('ShiaiCategory', function(Blueprint $table) {
			$table->foreign('tournamentId')->references('id')->on('Tournament')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Association', function(Blueprint $table) {
			$table->foreign('adminId')->references('id')->on('Users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Club', function(Blueprint $table) {
			$table->foreign('asocId')->references('id')->on('Association')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('Shinpan', function(Blueprint $table) {
			$table->dropForeign('Shinpan_userId_foreign');
		});
		Schema::table('Shinpan', function(Blueprint $table) {
			$table->dropForeign('Shinpan_shiaiCategoryId_foreign');
		});
		Schema::table('Tournament', function(Blueprint $table) {
			$table->dropForeign('Tournament_placeId_foreign');
		});
		Schema::table('Users', function(Blueprint $table) {
			$table->dropForeign('Users_gradeId_foreign');
		});
		Schema::table('Users', function(Blueprint $table) {
			$table->dropForeign('Users_countryId_foreign');
		});
		Schema::table('Competitor', function(Blueprint $table) {
			$table->dropForeign('Competitor_userId_foreign');
		});
		Schema::table('Competitor', function(Blueprint $table) {
			$table->dropForeign('Competitor_shiaiCategoryId_foreign');
		});
		Schema::table('Competitor', function(Blueprint $table) {
			$table->dropForeign('Competitor_clubId_foreign');
		});
		Schema::table('Fight', function(Blueprint $table) {
			$table->dropForeign('Fight_shiaiCategoryId_foreign');
		});
		Schema::table('Team', function(Blueprint $table) {
			$table->dropForeign('Team_shiaiCategoryId_foreign');
		});
		Schema::table('ShiaiCategory', function(Blueprint $table) {
			$table->dropForeign('ShiaiCategory_tournamentId_foreign');
		});
		Schema::table('Association', function(Blueprint $table) {
			$table->dropForeign('Association_adminId_foreign');
		});
		Schema::table('Club', function(Blueprint $table) {
			$table->dropForeign('Club_asocId_foreign');
		});
	}
}