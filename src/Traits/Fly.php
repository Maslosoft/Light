<?php

use Maslosoft\Light\Traits;

use Maslosoft\Light\Context;

trait Fly {
    public static function fly($instanceId) {
        // Generate a unique context key based on class and instance ID
        $contextKey = static::class . '.' . $instanceId;

        // Check if the instance already exists in the current context
        if (Context::exists($contextKey)) {
            $data = Context::get($key);
            $data['last_used'] = $now;
            Context::put($key, $data);
            return $data['instance'];
        }

        // Create a new instance using the abstract newInstance method
        $instance = static::newInstance($instanceId);

        Context::put($key, [
            'instance' => $instance,
            'created_at' => $now,
            'last_used' => $now
        ]);

        return $object;
      
        // Store the instance in the context with the class-based key
        Context::put($contextKey, $instance);

        return $instance;
    }

    // This method should be implemented by the class using the trait
    abstract protected static function newInstance($instanceId);
}
