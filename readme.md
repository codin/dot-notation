# Dot Notation Array Access

Fetching array items by dot notation

```php
$dot = new Codin\Dot(['foo' => ['bar' => 'baz']]);

$dot->get() // ['foo' => ['bar' => 'baz']]
$dot->get('foo') // ['bar' => 'baz']
$dot->get('foo.bar') // 'baz'
$dot->get('foo.bar.qux') // null
$dot->get('foo.bar.qux', 'hello') // 'hello'
```

```php
$dot->set('foo.bar', 'qux');
$dot->get() // ['foo' => ['bar' => 'qux']]

$dot->set('foo.bar.baz', 'qux'); // throws DotException the value at the index is not an array and wont be converted.
// Instead store the value as an array to overwrite
$dot->set('foo.bar', ['baz' => 'qux']);
```
