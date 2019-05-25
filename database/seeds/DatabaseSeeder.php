<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call('lock');
    }
}

class loaitin extends Seeder{
    public function run(){
        DB::table('loaitin')->insert([
            array('name'=>'Loại tin 1', 'descriptions'=>'Đây là loại tin 1'),
            array('name'=>'Loại tin 2', 'descriptions'=>'Đây là loại tin 2'),
            array('name'=>'Loại tin 3', 'descriptions'=>'Đây là loại tin 3'),

        ]);

    }
}

class tags extends Seeder{
    public function run(){
        DB::table('tags')->insert([
            array('name'=>'Tags 1'),
            array('name'=>'Tags 2'),
            array('name'=>'Tags 3'),
            array('name'=>'Tags 4'),
            array('name'=>'Tags 5'),

        ]);
    }
}

class baiviet extends Seeder{
    public  function  run(){
        DB::table('baiviet')->insert([
            array('id_loaitin'=>1, 'title'=>'Title bài viết 1', 'descriptions'=>'Đây là bài viết 1', 'content'=>'Đây là Content 1', 'images'=>'images 1'),
            array('id_loaitin'=>1, 'title'=>'Title bài viết 2', 'descriptions'=>'Đây là bài viết 2', 'content'=>'Đây là Content 2', 'images'=>'images 2'),
            array('id_loaitin'=>1, 'title'=>'Title bài viết 3', 'descriptions'=>'Đây là bài viết 3', 'content'=>'Đây là Content 3', 'images'=>'images 3'),
            array('id_loaitin'=>2, 'title'=>'Title bài viết 4', 'descriptions'=>'Đây là bài viết 4', 'content'=>'Đây là Content 4', 'images'=>'images 4'),
            array('id_loaitin'=>2, 'title'=>'Title bài viết 5', 'descriptions'=>'Đây là bài viết 5', 'content'=>'Đây là Content 5', 'images'=>'images 5'),
            array('id_loaitin'=>2, 'title'=>'Title bài viết 6', 'descriptions'=>'Đây là bài viết 6', 'content'=>'Đây là Content 6', 'images'=>'images 6'),
            array('id_loaitin'=>3, 'title'=>'Title bài viết 7', 'descriptions'=>'Đây là bài viết 7', 'content'=>'Đây là Content 7', 'images'=>'images 7'),
            array('id_loaitin'=>3, 'title'=>'Title bài viết 8', 'descriptions'=>'Đây là bài viết 8', 'content'=>'Đây là Content 8', 'images'=>'images 8'),
            array('id_loaitin'=>3, 'title'=>'Title bài viết 9', 'descriptions'=>'Đây là bài viết 9', 'content'=>'Đây là Content 9', 'images'=>'images 9'),
            array('id_loaitin'=>3, 'title'=>'Title bài viết 10', 'descriptions'=>'Đây là bài viết 10', 'content'=>'Đây là Content 10', 'images'=>'images 10'),
        ]);
    }
}

class accessories extends Seeder{
    public  function run(){
        DB::table('table_accessories')->insert([
            array('id_tags'=>1, 'id_baiviet'=>1),
            array('id_tags'=>2, 'id_baiviet'=>1),
            array('id_tags'=>3, 'id_baiviet'=>2),
            array('id_tags'=>5, 'id_baiviet'=>5),
            array('id_tags'=>5, 'id_baiviet'=>6),
        ]);
    }
}

class lock extends Seeder{
    public  function run(){
        DB::table('lock')->insert([
            array('key_id'=>1, 'name'=>'Lock 1'),
            array('key_id'=>2,'name'=>'Lock 2'),
            array('key_id'=>3,'name'=>'Lock 3'),
            array('key_id'=>4,'name'=>'Lock 4'),
            array('key_id'=>5,'name'=>'Lock 5'),
        ]);
    }
}

class key extends Seeder{
    public  function run(){
        DB::table('key')->insert([
            array('key'=>'key 1'),
            array('key'=>'key 2'),
            array('key'=>'key 3'),
            array('key'=>'key 4'),
            array('key'=>'key 5'),
        ]);
    }
}
