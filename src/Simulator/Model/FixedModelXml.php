<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class FixedModelXml
 * @package Simulator\Model
 */
class FixedModelXml implements ModelXmlInterface
{
    /**
     * Returns the model xml as a string
     *
     * @return string
     */
    public function getAsString(): string
    {
        $model = <<<MODEL
<mujoco>
    <option timestep="0.001" viscosity="0.00002" density="1.2" gravity="0 0 -9.81" collision="dynamic" />
    <compiler coordinate="global" angle="degree"/>
    <default>
        <geom rgba=".8 .6 .4 1"/>
        <joint limited="true"/>
    </default>
    <asset>
        <texture type="skybox" builtin="gradient" rgb1="1 1 1" rgb2=".6 .8 1" width="256" height="256"/>
    </asset>
    <worldbody>
        <geom name="reference" pos="0 0 -6" size=".5 .5 .5" type="box" rgba="0 0 0 1"/>
        <geom name="floor" pos="0 0 -4" size="50 50 .125" rgba="0 1 0 1" type="plane" condim="3"/>
        <body name="body_0">
            <freejoint/>
            <site name="head" size="0.2 0.2 0.2" rgba="1 0 0 0.5"/>
            <geom name="geom_0" type="sphere" pos="0.00 0.00 0.20" size="0.04"/>
            <body name="body_1">
                <geom name="geom_1" type="capsule" fromto="0.00 0.00 0.00 1.00 0.00 0.00" size="0.100000"/>
                <geom name="geom_2" type="capsule" fromto="0.00 0.00 0.00 0.00 1 0.00"  size="0.100000"/>
                <geom name="geom_3" type="capsule" fromto="0.00 0.00 0.00 -0.50 -0.50 0.00" size="0.100000"/>
                <geom name="geom_4" type="capsule" fromto="-0.50 -0.50 0.00 -0.80 -0.80 -2.00" size="0.100000"/>
                <body name="body_2">
                    <joint type="hinge" pos="1.00 0.00 0.00" axis="0 1 0" limited="true" range="-50 0" name="motor_0"/>
                    <geom name="geom_5" type="capsule" fromto="1.00 0.00 0.00 1.00 0.00 -1" size="0.100000"/>
                    <body name="body_4">
                        <joint type="hinge" pos="1.00 0.00 -1" axis="0 1 0" limited="true" range="0 35" name="motor_2"/>
                        <geom name="geom_6" type="capsule" fromto="1.00 0.00 -1 1.00 0.00 -2" size="0.100000"/>
                    </body>
                </body>
                <body name="body_3">
                    <joint type="hinge" pos="0.00 1.00 0.00" axis="1 0 0" limited="true" range="0 50" name="motor_1"/>
                    <geom name="geom_7" type="capsule" fromto="0.00 1.00 0.00 0.00 1.00 -1" size="0.100000"/>
                    <body name="body_5">
                        <joint type="hinge" pos="0.00 1.00 -1" axis="1 0 0" limited="true" range="-35 0" name="motor_3"/>
                        <geom name="geom_8" type="capsule" fromto="0.00 1.00 -1 0.00 1.00 -2" size="0.100000"/>
                    </body>
                </body>
            </body>
        </body>
    </worldbody>

    <actuator>
        <motor name="motor_0" joint="motor_0" gear="50"/>
        <motor name="motor_1" joint="motor_1" gear="50"/>
        <motor name="motor_2" joint="motor_2" gear="50"/>
        <motor name="motor_3" joint="motor_3" gear="50"/>
    </actuator>
</mujoco>
MODEL;

        return $model;
    }
}
