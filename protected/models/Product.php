<?php


class Product extends CActiveRecord
{
	
	public function tableName()
	{
		return 'product';
	}

	
	public function rules()
	{
		
		return array(
			array('book_name, date_of_write, author, description, img_path, publisher, date_of_publish, price, quantity', 'required'),
			array('date_of_write, date_of_publish, price, quantity', 'numerical', 'integerOnly'=>true),
			array('book_name, author, img_path, publisher', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, book_name, date_of_write, author, description, img_path, publisher, date_of_publish, price, quantity', 'safe', 'on'=>'search'),
		);
	}


	public function relations()
	{
		

		return array(
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'book_name' => 'Book Name',
			'date_of_write' => 'Date Of Write',
			'author' => 'Author',
			'description' => 'Description',
			'img_path' => 'Img Path',
			'publisher' => 'Publisher',
			'date_of_publish' => 'Date Of Publish',
			'price' => 'Price',
			'quantity' => 'Quantity',
		);
	}

	
	public function search()
	{
	

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('book_name',$this->book_name,true);
		$criteria->compare('date_of_write',$this->date_of_write);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('img_path',$this->img_path,true);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('date_of_publish',$this->date_of_publish);
		$criteria->compare('price',$this->price);
		$criteria->compare('quantity',$this->quantity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
